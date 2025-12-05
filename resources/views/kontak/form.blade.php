@extends('layouts.app')
@section('title', 'Kontak')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger text-center mb-4">
    {{ session('error') }}
</div>
@endif


<section id="contact-us" class="contact-us section py-5">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <div class="section-title">
                        <h2>Contact Us</h2>
                        <p>Please contact us using the form below or the contact information below.</p>
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="single-info-head">
                            <div class="single-info">
                                <i class="lni lni-map"></i>
                                <h3>Address</h3>
                                <ul>
                                    <li>Bandung jln Antapani<br> RT 08/RW 05, INA.</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="lni lni-phone"></i>
                                <h3>Call us on</h3>
                                <ul>
                                    <li><a href="tel:+18005554400">+6285136320395</a></li>
                                    <li><a href="tel:+321556667890">+62895352458583</a></li>
                                    <li><a href="tel:+321556667890">+6285182784043</a></li>

                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="lni lni-envelope"></i>
                                <h3>Mail at</h3>
                                <ul>
                                    <li><a href="mailto:support@shopgrids.com">support@shopgrids.com</a></li>
                                    <li><a href="mailto:career@shopgrids.com">career@shopgrids.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                                <form class="form" method="POST" action="{{ route('kontak.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="nama" type="text" placeholder="Your Name"
                                                    value="{{ old('nama') }}" class="@error('nama') is-invalid @enderror">
                                                @error('nama')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="email" type="email" placeholder="Your Email"
                                                    value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                                                @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group message">
                                                <textarea name="pesan" id="pesan" placeholder="Your Message"
                                                    rows="4" class="@error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                                                @error('pesan')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn">Submit Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection