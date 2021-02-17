<!DOCTYPE html>
<html {{ language_attributes() }} class="no-js">
    <head>

        <meta charset="{{ get_bloginfo( 'charset' ) }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <script>
            var hostname = "{{ constant('HOSTNAME') }}";
            var ajaxurl = "{{ constant('HOSTNAME') }}/wp-admin/admin-ajax.php";
        </script>

        {{ wp_head() }}

        @include('layout.seo')

        @include('layout.services')

        <link rel="stylesheet" href="{{ \Helpers\General::asset_hash('/wp-content/themes/classy/dist/main.css') }}">
    </head>

    <body {{ body_class($body_additional) }}>

        {{ wp_body_open() }}

        <div class="wrapper" id="top">
            {{ get_header() }}

            <div class="content">
                @yield('content')
            </div>

            {{ get_footer() }}
        </div>

        {{ wp_footer() }}

        <script src="{{ \Helpers\General::asset_hash('/wp-content/themes/classy/dist/index.js') }}"></script>

        {{--@if(in_array(wp_get_environment_type(), ['local', 'development']))
            <script src="http://localhost:35729/livereload.js"></script>
        @endif--}}
    </body>
</html>
