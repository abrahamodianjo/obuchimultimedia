@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Onyebuchi Odianjo Page </h4>

                            <form method="post" action="{{ route('update.onyebuchi.odianjo') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $onyebuchiodianjopage->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text"
                                            value="{{ $onyebuchiodianjopage->title }}" id="example-text-input">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title </label>
                                    <div class="col-sm-10">
                                        <input name="short_title" class="form-control" type="text"
                                            value="{{ $onyebuchiodianjopage->short_title }}" id="example-text-input">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Description
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea required="" name="short_description" class="form-control"
                                            rows="5">{{ $onyebuchiodianjopage->short_description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Long Description
                                    </label>
                                    <div class="col-sm-10">

                                        <textarea id="elm1"
                                            name="long_description">{{ $onyebuchiodianjopage->long_description }}</textarea>

                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Buchi Image </label>
                                    <div class="col-sm-10">
                                        <input name="onyebuchiodianjo_image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ (!empty($onyebuchiodianjopage->onyebuchiodianjo_image)) ? url($onyebuchiodianjopage->onyebuchiodianjo_image) : url('upload/no_image.jpg') }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-danger waves-effect waves-light"
                                    value="Update">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


    <script type="text/javascript">

        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>

@endsection