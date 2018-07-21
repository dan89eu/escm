@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Project Importer
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" href="{{ asset('assets/vendors/blueimp-gallery-with-desc/css/blueimp-gallery.min.css') }}" />
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/blueimp-file-upload/css/jquery.fileupload.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/blueimp-file-upload/css/jquery.fileupload-ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/vendors/blueimp-file-upload/css/jquery.fileupload-noscript.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/blueimp-file-upload/css/jquery.fileupload-ui-noscript.css') }}" />
    </noscript>
<style>
    @media(min-width:320px) and (max-width:425px){
        .fileupload-buttonbar .btn, .fileupload-buttonbar .toggle{
            display:inline-block !important;
        }
        .cancel,.start{
            margin-top:5px;
        }
        .files .toggle{
            display:block;
        }
    }
</style>
@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Project Importer</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Projects</li>
            <li class="active">Project Importer</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Project Importer
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <blockquote>
                                <p>
                                    Excel Importer
                                </p>
                            </blockquote>
                            {!! Form::open(array('url' => URL::to('admin/file/createmulti'), 'method' => 'post', 'id'=>'fileupload', 'files'=> true)) !!}
                                    <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript>
                                <input type="hidden" name="redirect" value="">
                            </noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn btn-success fileinput-button">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Add files</span>
                                                    <input type="file" name="file">
                                                </span>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                    <input type="checkbox" class="toggle">
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>

                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped">
                                <tbody class="files"></tbody>
                            </table>

                            <table id="filesImporter" class="table table-striped">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- content -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.ui.widget.js') }}" ></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="{{ asset('assets/vendors/blueimp-tmpl/js/tmpl.min.js') }}" ></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="{{ asset('assets/vendors/blueimploadimage/js/load-image.all.min.js') }}"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="{{ asset('assets/vendors/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') }}" ></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="{{ asset('assets/vendors/blueimp-gallery-with-desc/js/jquery.blueimp-gallery.min.js') }}" ></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.iframe-transport.js') }}" ></script>
    <!-- The basic File Upload plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload.js') }}" ></script>
    <!-- The File Upload processing plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-process.js') }}" ></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-image.js') }}" ></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-audio.js') }}" ></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-video.js') }}" ></script>
    <!-- The File Upload validation plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-validate.js') }}" ></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{ asset('assets/vendors/blueimp-file-upload/js/jquery.fileupload-ui.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
    <script>
        $( document ).ready(function() {

	        var oTable;

            $('#fileupload').fileupload({
                url: '{{URL::to('admin/file/createmulti')}}',
                dataType: 'json',
                maxNumberOfFiles: 1
            })
                .bind('fileuploaddestroy', function (e, data) {
	                $('#filesImporter').DataTable()
		            .clear()
		            .destroy();
	                $('#filesImporter').empty()
            })
	            .bind('fileuploaddone', function (e, data) {

		            console.log(e,data, data.getFilesFromResponse(data))
		            var file = data.getFilesFromResponse(data)[0]
		            $.get("/admin/projects/importpreview/"+file.fileID,function(data){

			            console.log(data)

			            if(data.success && data.data.length>0)
			            {
				            var rows = data.data;
				            console.log(Object.keys(rows[0]))
				            var header_rows = Object.keys(rows[0]).map(function(z) {
					            return '<tr>' + z  + '</tr>'
				            }).join("");

				            var column_titles = Object.keys(rows[0]).map(function(header) {
					            return {
						            'title': header
					            };
				            });

				            var dataSet = new Array;
				            $.each(rows, function (index, value) {
					            var tempArray = new Array;
					            for (var o in value) {
						            tempArray.push(value[o]);
					            }
					            dataSet.push(tempArray);
				            })


				            //$("#filesImporter thead").html(header_rows);
				            oTable = $('#filesImporter').dataTable({
					            "columns": column_titles,
					            "scrollX": true,
					            "data": dataSet,
					            "colReorder": {
						            order:[20,21,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
					            },
				            });
			            }

		            })
                })
	            .bind('fileuploadprocessdone', function (e, data) {
		            console.log(e,data, data.getFilesFromResponse(data))
                })
	        /* Apply the jEditable handlers to the table */
	        $('#filesImporter tbody td').editable(function (sValue) {
		        /* Get the position of the current data from the node */
		        var aPos = oTable.fnGetPosition(this);

		        /* Get the data array for this row */
		        var aData = oTable.fnGetData(aPos[0]);

		        /* Update the data array and return the value */
		        aData[aPos[1]] = sValue;
		        return sValue;
	        });

	        $( "#fileupload" ).on( "click", ".import",function(event) {
		        event.preventDefault();
		        console.log(event)
                console.log($(event.currentTarget).data("url"))

		        $.post( $(event.currentTarget).data("url"), function( data ) {
			        console.log( data );
		        });

	        });
	        /* Submit the form when bluring a field */

	        /* Init DataTables */

        });

    </script>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) {

    %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <button class="btn btn-success import" data-url="/admin/projects/import/{%=file.fileID%}" type="button">
                    <i class="glyphicon glyphicon-import"></i>
                    <span>Import</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>

@stop
