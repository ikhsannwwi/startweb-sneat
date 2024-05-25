@extends('administrator.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header">
                        Settings
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Menu Setting</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.settings.admin') }}">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Smtp</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.settings.admin.smtp.update') }}" method="post"
                                enctype="multipart/form-data" class="form" id="form" data-parsley-validate>
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="hostField" class="form-label">Host</label>
                                            <input type="text" id="hostField" class="form-control"
                                                placeholder="Masukan Host"
                                                value="{{ array_key_exists('smtp_host_admin', $settings) ? $settings['smtp_host_admin'] : '' }}"
                                                name="smtp_host_admin" autocomplete="off" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="securityField" class="form-label">Security</label>
                                            <input type="text" id="securityField" class="form-control"
                                                placeholder="Masukan Security"
                                                value="{{ array_key_exists('smtp_security_admin', $settings) ? $settings['smtp_security_admin'] : '' }}"
                                                name="smtp_security_admin" autocomplete="off" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="portField" class="form-label">Port</label>
                                            <input type="text" id="portField" class="form-control"
                                                placeholder="Masukan Port"
                                                value="{{ array_key_exists('smtp_port_admin', $settings) ? $settings['smtp_port_admin'] : '' }}"
                                                name="smtp_port_admin" autocomplete="off" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="userField" class="form-label">User</label>
                                            <input type="text" id="userField" class="form-control"
                                                placeholder="Masukan User"
                                                value="{{ array_key_exists('smtp_user_admin', $settings) ? $settings['smtp_user_admin'] : '' }}"
                                                name="smtp_user_admin" autocomplete="off" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="passwordField" class="form-label">Password</label>
                                            <input type="text" id="passwordField" class="form-control"
                                                placeholder="Masukan Password"
                                                value="{{ array_key_exists('smtp_password_admin', $settings) ? $settings['smtp_password_admin'] : '' }}"
                                                name="smtp_password_admin" autocomplete="off" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" id="formSubmit" class="btn btn-primary mx-1 mb-1">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress" style="display: none;">
                                                Tunggu Sebentar...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                        <button type="reset" class="btn btn-secondary mx-1 mb-1">Reset</button>
                                        <a href="{{ route('admin.settings.admin') }}"
                                            class="btn btn-danger mx-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset_administrator('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset_administrator('assets/plugins/parsleyjs/page/parsley.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //validate parsley form
            const form = document.getElementById("form");
            const validator = $(form).parsley();

            const submitButton = document.getElementById("formSubmit");

            // form.addEventListener('keydown', function(e) {
            //     if (e.key === 'Enter') {
            //         e.preventDefault();
            //     }
            // });

            submitButton.addEventListener("click", async function(e) {
                e.preventDefault();
                indicatorBlock();

                // Validate the form using Parsley
                if ($(form).parsley().validate()) {
                    indicatorSubmit();

                    // Submit the form
                    form.submit();
                } else {
                    // Handle validation errors
                    const validationErrors = [];
                    $(form).find(':input').each(function() {
                        const field = $(this);
                        if (!field.parsley().isValid()) {
                            indicatorNone();
                            const attrName = field.attr('name');
                            const errorMessage = field.parsley().getErrorsMessages().join(
                                ', ');
                            validationErrors.push(attrName + ': ' + errorMessage);
                        }
                    });
                    console.log("Validation errors:", validationErrors.join('\n'));
                }
            });

            function indicatorSubmit() {
                submitButton.querySelector('.indicator-label').style.display =
                    'inline-block';
                submitButton.querySelector('.indicator-progress').style.display =
                    'none';
            }

            function indicatorNone() {
                submitButton.querySelector('.indicator-label').style.display =
                    'inline-block';
                submitButton.querySelector('.indicator-progress').style.display =
                    'none';
                submitButton.disabled = false;
            }

            function indicatorBlock() {
                // Disable the submit button and show the "Please wait..." message
                submitButton.disabled = true;
                submitButton.querySelector('.indicator-label').style.display = 'none';
                submitButton.querySelector('.indicator-progress').style.display =
                    'inline-block';
            }

        });
    </script>
@endpush
