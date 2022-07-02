@extends('layouts.front')
@section('content')

<div class="pt-50 pb50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <h3>Contact Us</h3>
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            
                                            <div class="form-group">
                                                <select id="comment" required="required" aria-required="true" class="custom-select">
                                                    <option value="">Please Select</option>
                                                    <option value="Customer Support">Customer Support</option>
                                                    <option value="Comments">Comments</option>
                                                    <option value="Business Buy Back">Business Buy Back</option>
                                                    <option value="Sell In Bulk">Sell In Bulk</option>
                                                    <option value="Buy In Bulk">Buy In Bulk</option>
                                                    <option value="Recycling">Recycling</option>
                                                    <option value="Press Inquiries">Press Inquiries</option>
                                                    <option value="Business Development and Partnerships">Business Development and Partnerships</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="fname" type="text" placeholder="First Name" required="required" aria-required="true" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input id="lname" type="text" placeholder="Last Name" required="required" aria-required="true" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input id="email" type="email" placeholder="Email address" required="required" aria-required="true" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input id="phone" type="text" placeholder="Phone Number" required="required" aria-required="true" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <textarea id="message" placeholder="Messages" required="required" rows="5" wrap="soft" aria-required="true" class="form-control"></textarea>
                                            </div>
                                            <form>
                                                <div id="group-comment" role="group" class="form-group"></div>
                                                <div id="group-fname" role="group" class="form-group"></div>
                                                <div id="group-lname" role="group" class="form-group"></div>
                                                <div id="group-email" role="group" class="form-group"></div>
                                                <div id="group-phone" role="group" class="form-group"></div>
                                                <div id="group-message" role="group" class="form-group"></div>
                                                <button type="submit" class="btn btn-outline-dark btn-lg">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <iframe data-v-df212a54="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3097.2195538694464!2d-94.41648289308372!3d39.07869647373669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0fdf2628895ff%3A0x74b538aa176b05bc!2sTronics%20Pay!5e0!3m2!1sen!2sph!4v1605701145623!5m2!1sen!2sph" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen" aria-hidden="false" tabindex="0" __idm_id__="715286529" id="igrcx"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
<link href="{{ url('assets/css/contactus.css') }}" rel="stylesheet">
@endsection




                                        
                                            
                                            

