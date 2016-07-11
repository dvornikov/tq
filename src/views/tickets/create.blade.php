@extends('tq::layouts.app')

@section('content')
    <h2>{{ trans('tq::messages.create') }}</h2>
    {!! Form::open([
        'route' => 'tickets.store'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail:', ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('files', 'files:', ['class' => 'control-label']) !!}
        <div class="dropzone" id="dropzoneFileUpload"></div>
    </div>

    {!! Form::hidden('_id', $id) !!}

    {!! Form::submit(trans('tq::messages.create'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

    <script type="text/javascript">
        $(function() {
            var baseUrl = "{{ route('files.add') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                url: baseUrl,
                paramName: "filefield", // The name that will be used to transfer the file
                params: {
                    _token: token,
                    _id: "{{ $id }}"
                }
            });


            $('form').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: '{{ trans('tq::messages.not_empty') }}'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: '{{ trans('tq::messages.not_empty') }}'
                                },
                                emailAddress: {
                                    message: '{{ trans('tq::messages.email') }}'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: '{{ trans('tq::messages.not_empty') }}'
                                }
                            }
                        }
                    }
                })
                .on('success.field.fv', function(e, data) {
                    if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
                        data.fv.disableSubmitButtons(true);
                    }
                });
        })
    </script>
@endsection
