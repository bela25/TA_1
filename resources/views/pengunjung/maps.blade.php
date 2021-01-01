@extends('layouts.pengunjung')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css" type="text/css">
<style type="text/css">
  .hero-wrap.hero-wrap-2{
    height: 120px !important;
  }
  p.price span{
    font-size: 24px !important;
  }
  .map {
    height: 400px;
    width: 100%;
  }
</style>
@endpush

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
</section>

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">Maps</span>
        <h2 class="mb-2">Lokasi Apartemen</h2>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-md-12">
        <div id="maps" class="map"></div>
      </div>
    </div>
    
  </div>
  <!-- container -->
</section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
<script type="text/javascript">
  var lon = ('{{$lokasi->longitude}}');
  var lat = ('{{$lokasi->latitude}}');
  var stroke_hitam = new ol.style.Stroke({color: 'black', width: 1});
  var fill_orange = new ol.style.Fill({color: 'rgba(255, 140, 0, 0.5)'});
  var style_circle = new ol.style.Style({
    image: new ol.style.Circle({
      fill: fill_orange,
      stroke: stroke_hitam,
      radius: 12,
    })
  });
  var format =  new ol.format.WKT();
  feature = format.readFeature('POINT('+lon+' '+lat+')', {
    dataProjection: 'EPSG:4326',
    featureProjection: 'EPSG:3857'
  });
  var source = new ol.source.Vector({
    features: [feature]
  });
  var lokasi = new ol.layer.Vector({
    source: source,
    style: style_circle,
    visible: true,
  });

  var map = new ol.Map({
    target: 'maps',
    controls: [
      //Define the default controls
      new ol.control.Zoom(),
      new ol.control.Rotate(),
      new ol.control.Attribution(),
      //Define some new controls
      new ol.control.ZoomSlider(),
      new ol.control.MousePosition(),
      new ol.control.ScaleLine(),
      new ol.control.OverviewMap()
    ],
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      }),
      lokasi,
    ],
    view: new ol.View({
      center: ol.proj.fromLonLat([lon,lat]),
      zoom: 12
    })
  });
</script>
@endpush