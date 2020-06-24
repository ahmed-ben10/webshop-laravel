@extends('layouts.admin')

@section('main')
<div id='map' class='map'>
    <div id='foldable' class='tt-overlay-panel -left-top -medium js-foldable'>
        <form id=form>
            <div id='startSearchBox' class='searchbox-container'>
                <div class='tt-icon tt-icon-size icon-spacing-right -start'></div>
            </div>
            <div id='finishSearchBox' class='searchbox-container'>
                <div class='tt-icon tt-icon-size icon-spacing-right -finish'></div>
            </div>
        </form>
    </div>
</div>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps-web.min.js'></script>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/services/services-web.min.js'></script>
<script type='text/javascript' src='../assets/js/mobile-or-tablet.js'></script>
<script type='text/javascript' src='../assets/js/info-hint.js'></script>
<script type='text/javascript' src='../assets/js/foldable.js'></script>
<script>
    var map = tt.map({
        key: 'FFcG3oHKzkmOEuGdBs9AWut3A34AR0on',
        container: 'map',
        style: 'tomtom://vector/1/basic-main',
        dragPan: !window.isMobileOrTablet()
    });
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
    new Foldable('#foldable', 'top-right');

    var bounds = new tt.LngLatBounds();

    function RoutingAB() {
        this.state = {
            start: undefined,
            finish: undefined,
            marker: {
                start: undefined,
                finish: undefined
            }
        };

        this.startSearchbox = this.createSearchBox('start');
        this.createSearchBox('finish');

        this.closeButton = document.querySelector('.tt-search-box-close-icon');
        this.startSearchboxInput = this.startSearchbox.getSearchBoxHTML().querySelector('.tt-search-box-input');

        this.startSearchboxInput.addEventListener('input', this.handleSearchboxInputChange.bind(this));

        this.createMyLocationButton();
        this.switchToMyLocationButton();

        this.errorHint = new InfoHint('error', 'bottom-center', 5000)
            .addTo(document.getElementById('map'));
    }

    RoutingAB.prototype.createMyLocationButton = function() {
        this.upperSearchboxIcon = document.createElement('div');
        this.upperSearchboxIcon.setAttribute('class', 'my-location-button');

        this.upperSearchboxIcon.addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(
                this.reverseGeocodeCurrentPosition.bind(this),
                this.handleError.bind(this)
            );
        }.bind(this));
    };

    RoutingAB.prototype.handleSearchboxInputChange = function(event) {
        var inputContent = event.target.value;

        if (inputContent.length > 0) {
            this.setCloseButton();
        } else {
            var resultList = this.startSearchbox.getSearchBoxHTML().querySelector('.tt-search-box-result-list');

            if (resultList || inputContent.length === 0) {
                return;
            }

            this.onResultCleared('start');
        }
    };

    RoutingAB.prototype.reverseGeocodeCurrentPosition = function(position) {
        this.state.start = [position.coords.longitude, position.coords.latitude];

        tt.services.reverseGeocode({
            key: 'FFcG3oHKzkmOEuGdBs9AWut3A34AR0on',
            position: this.state.start
        })
            .go()
            .then(this.handleRevGeoResponse.bind(this))
            .catch(this.handleError.bind(this));
    };

    RoutingAB.prototype.handleRevGeoResponse = function(response) {
        var place = response.addresses[0];
        this.state.start = [place.position.lng, place.position.lat];
        this.startSearchboxInput.value = place.address.freeformAddress;
        this.onResultSelected('start');
    };

    RoutingAB.prototype.calculateRoute = function() {
        if (map.getLayer('route')) {
            map.removeLayer('route');
            map.removeSource('route');
        }

        if (!this.state.start || !this.state.finish) {
            return;
        }
        this.errorHint.hide();
        var startPos = this.state.start.join(',');
        var finalPos = this.state.finish.join(',');

        tt.services.calculateRoute({
            key: 'FFcG3oHKzkmOEuGdBs9AWut3A34AR0on',
            traffic: false,
            locations: startPos + ':' + finalPos
        })
            .go()
            .then(function(response) {
                var geojson = response.toGeoJson();
                map.addLayer({
                    'id': 'route',
                    'type': 'line',
                    'source': {
                        'type': 'geojson',
                        'data': geojson
                    },
                    'paint': {
                        'line-color': '#2faaff',
                        'line-width': 8
                    }
                }, this.findFirstBuildingLayerId());
            }.bind(this))
            .catch(this.handleError.bind(this));
    };

    RoutingAB.prototype.handleError = function(error) {
        this.errorHint.setErrorMessage(error);
    };

    RoutingAB.prototype.drawMarker = function(type) {
        if (this.state.marker[type]) {
            this.state.marker[type].remove();
        }

        var marker = document.createElement('div');
        var innerElement = document.createElement('div');

        marker.className = 'route-marker';
        innerElement.className = 'icon tt-icon -white -' + type;
        marker.appendChild(innerElement);

        this.state.marker[type] = new tt.Marker({ element: marker })
            .setLngLat(this.state[type])
            .addTo(map);

        this.updateBounds();
    };

    RoutingAB.prototype.updateBounds = function() {
        bounds = new tt.LngLatBounds();

        if (this.state.start) {
            bounds.extend(tt.LngLat.convert(this.state.start));
        }
        if (this.state.finish) {
            bounds.extend(tt.LngLat.convert(this.state.finish));
        }
        if (!bounds.isEmpty()) {
            map.fitBounds(bounds, { duration: 0, padding: 100 });
        }
    };

    RoutingAB.prototype.createSearchBox = function(type) {
        var searchBox = new tt.plugins.SearchBox(tt.services, {
            showSearchButton: false,
            searchOptions: {
                key: 'FFcG3oHKzkmOEuGdBs9AWut3A34AR0on'
            },
            placeholder: 'Search for a place...'
        });
        document.getElementById(type + 'SearchBox').appendChild(searchBox.getSearchBoxHTML());
        searchBox.on('tomtom.searchbox.resultselected', this.onResultSelected.bind(this, type));
        searchBox.on('tomtom.searchbox.resultscleared', this.onResultCleared.bind(this, type));

        return searchBox;
    };

    RoutingAB.prototype.onResultSelected = function(type, event) {
        if (event) {
            var pos = event.data.result.position;
            this.state[type] = [pos.lng, pos.lat];
        }
        if (type === 'start') {
            this.setCloseButton();
        }

        this.drawMarker(type);
        this.calculateRoute();
    };

    RoutingAB.prototype.onResultCleared = function(type) {
        this.state[type] = undefined;

        if (this.state.marker[type]) {
            this.state.marker[type].remove();
            this.updateBounds();
        }
        if (type === 'start') {
            this.switchToMyLocationButton();
        }

        this.calculateRoute();
    };

    RoutingAB.prototype.setCloseButton = function() {
        var inputContainer = document.querySelector('.tt-search-box-input-container');
        this.closeButton.classList.remove('hidden');

        if (document.querySelector('.my-location-button')) {
            inputContainer.replaceChild(this.closeButton, this.upperSearchboxIcon);
        }
    };

    RoutingAB.prototype.switchToMyLocationButton = function() {
        var inputContainer = document.querySelector('.tt-search-box-input-container');
        inputContainer.replaceChild(this.upperSearchboxIcon, this.closeButton);
    };

    RoutingAB.prototype.findFirstBuildingLayerId = function() {
        var layers = map.getStyle().layers;
        for (var index in layers) {
            if (layers[index].type === 'fill-extrusion') {
                return layers[index].id;
            }
        }

        throw new Error('Map style does not contain any layer with fill-extrusion type.');
    };

    new RoutingAB();
</script>

@endsection
