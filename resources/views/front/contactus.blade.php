@extends('layouts.front')
@section('content')
<?php
  $result = @json_decode($page->content);
?>
<section class="contact-section pt-70">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mt-50">
        <div class="text-center"><h1 class="contactus-header">Contact Us</h1></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="contact-wrapper pb-50">
          <form class="">
            <div id="group-comment" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <select id="comment" required="required" aria-required="true" class="custom-select">
                  <option value="">Please Select</option>
                  <option value="Comments">Comments</option>
                  <option value="Business Buy Back">Business Buy Back</option>
                  <option value="Sell In Bulk">Sell In Bulk</option>
                  <option value="Buy In Bulk">Buy In Bulk</option>
                  <option value="Recycling">Recycling</option>
                  <option value="Press Inquiries">Press Inquiries</option>
                  <option value="Business Development and Partnerships">Business Development and Partnerships</option>
                </select>
              </div>
            </div>
            <div id="group-fname" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <input id="fname" type="text" placeholder="First Name" required="required" aria-required="true" class="form-control" />
              </div>
            </div>
            <div id="group-lname" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <input id="lname" type="text" placeholder="Last Name" required="required" aria-required="true" class="form-control" />
              </div>
            </div>
            <div id="group-email" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <input id="email" type="email" placeholder="Enter email address" required="required" aria-required="true" class="form-control" />
              </div>
            </div>
            <div id="group-phone" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <input id="phone" type="text" placeholder="Phone Number" required="required" aria-required="true" class="form-control" />
              </div>
            </div>
            <div id="group-message" role="group" class="form-group">
              <div class="bv-no-focus-ring">
                <textarea id="message" placeholder="Message" required="required" rows="5" wrap="soft" aria-required="true" class="form-control"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-outline-dark btn-lg">Submit</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mt-50 pb-50">
          <iframe
            data-v-df212a54=""
            src="{{ $result->google_map }}"
            width="100%"
            height="450"
            frameborder="0"
            allowfullscreen="allowfullscreen"
            aria-hidden="false"
            tabindex="0"
            style="border: 0px;"
          ></iframe>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="contact-wrapper">
          <div class="text-center">
            <h1 class="email">How To Reach Us.</h1>
            <img src="{{ $result->image }}" class="img-fluid" />
          </div>
          <div class="row" style="color: rgb(176, 176, 180);">
            <div class="col-md-6 mt-30">
              <div class="media contact-media">
                <i class="far fa-fw fa-clock"></i>
                <div class="media-body">
                  <p data-v-df212a54="">
                    {!! $result->schedule !!}
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mt-30">
              <div class="media contact-media">
                <i class="fas fa-fw fa-map-marker-alt"></i>
                <div class="media-body footer-column"><p data-v-df212a54="">{{ $result->location }}</p></div>
              </div>
              <div class="media contact-media">
                <i class="fas fa-fw fa-phone-alt"></i>
                <div class="media-body footer-column"><p data-v-df212a54="">{{ $result->contact }}</p></div>
              </div>
              <div class="media contact-media">
                <i class="far fa-fw fa-envelope"></i>
                <div class="media-body footer-column"><p data-v-df212a54="">{{ $result->email }}</p></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('page-css')
<link href="{{ url('assets/css/contactus.css') }}" rel="stylesheet">
@endsection