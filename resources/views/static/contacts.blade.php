@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left">
                <div class="wrap">
                    <div class="extra-wrap">
                        {!! $text !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('jsScripts')
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto({
                showTitle: false,
                allowresize: true,
            });
        });
    </script>
@stop