@extends('layouts.app')
@section('title', 'Fit-india-walkathon-200-km-by-itbp| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

    <section id="{{ $active_section_id }}">
      <div class="container">
        <div class="row r-m">
          <div class="col-sm-12 col-md-12 r-m ">
            <h2 class="a_heading text-center">Fit India Walkathon 200 KM by ITBP​</h2>
            <p style="line-height: 2.5;"><strong>Be</strong> a part of the biggest Walkathon of 2020, walk will be
              hosted by <strong>DG ITBP</strong> and Flag off will be done by <strong>Shri Kiren Rijiju, Hon’ble Sports
                Minister of India.</strong></p>
            <br>
            <p><strong>Fit India Mission</strong> always encourages people to remain healthy and fit by including
              physical activities and sports in their daily lives. Since, its inception various activities have been
              organised by the Fit India Mission which have seen mass engagement and participation from all parts of the
              country. Another such initiative is the <strong>Fit India Walkathon 200 KM </strong>which will be anchored
              by the Indo-Tibetan Border Police in Jaisalmer (Rajasthan).</p>
          </div>
          <table class="tbl-dv">
            <tbody>
              <tr>
                <th colspan="2">Event Info</th>
              </tr>
              <tr>
                <td>Event Name</td>
                <td>Fit India Walkathon 200 KM by ITBP</td>
              </tr>
              <tr>
                <td>Place</td>
                <td>Jaisalmer (Rajasthan)</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>31st October – 2nd November (3 days Event)</td>
              </tr>
              <tr>
                <td>Starting Point</td>
                <td>Kishangarh</td>
              </tr>
              <tr>
                <td>Finishing point</td>
                <td>RD1366 (between Mohangarh and Nachna)</td>
              </tr>
              <tr>
                <td>Organized by</td>
                <td>ITBP</td>
              </tr>
            </tbody>
          </table>

          <p><strong><u>Note: </u></strong>Travelling cost to be borne by the participant, boarding and lodging cost
            will be taken care by ITBP.</p>
          <p style="font-size: 16px;">For further Information, please write an email to <a
              href="mailto:contact.fitindia@gmail.com" style="color:#ff6600;">contact.fitindia@gmail.com</a> for the
            justification of your credentials to become a part of this Walkathon 200KM</p>

          <div class="map_area">
            <br>
            <h2>Map Route</h2>
            <img src="{{ asset('resources/imgs/Mission-200-1.jpg') }}" class="img-fluid" />
          </div>

        </div>

      </div>
    </section>
@endsection