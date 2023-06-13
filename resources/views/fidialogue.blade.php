@extends('layouts.app')
@section('title', 'Fit India Dialogue | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

    <div class="banner_area1">
        <img src="{{ asset('resources/imgs/dialogue_Session-1.png') }}" alt="about-fitindia" class="img-fluid expand_img"/> 
            <section id="{{ $active_section_id }}">
                <div class="container">
                    <div class="row et_pb_row_2">
                        <div class="col-sm-12 ">
                         <h2>Dialogue Session 1</h2>
                            <p>Honourable Prime Minister to interact fitness enthusiasts from across the country in Fit India Dialogue</p>
                            <P>New Delhi, Sep 22, 2020: In a unique initiative, Honourable Prime Minister Shri. Narendra Modi will be interacting with fitness influencers and citizens during a nation-wide online Fit India Dialogue which is being organized to celebrate the first anniversary of the Fit India Movement on September 24, 2020.</P>
                            <p>The online interaction will see participants sharing anecdotes and tips of their own fitness journey while drawing out guidance from Honourable PM on his thoughts about fitness and good health. Among those who will participate range from Virat Kohli to Milind Soman to Rujuta Diwekar in addition to other fitness influencers.</p>   
                            <p>In times of Covid-19 Fitness has become an even more important aspect of life. This dialogue will see a timely and fruitful conversation on nutrition, wellness and various other aspects on fitness.</p>
                            <p>Envisioned by Honourable Prime Minister as a People’s Movement, the Fit India Dialogue is yet another endeavour to involve citizens of the country to draw out a plan to make India a Fit Nation. The basic tenet on which the Fit India Movement was envisaged, that of involving citizens to imbibe fun, easy and non-expensive ways in which to remain fit and therefore bring about a behavourial change which makes fitness an imperative part of every Indian’s life, is being strengthened by this dialogue.
                                In the past one year, since its launch, various events organised under the aegis of the Fit India Movement has seen enthusiastic participation of people from all walks of life and from across the country. The Fit India Freedom Run, Plog Run, Cyclothon, Fit India Week, Fit India School Certificate and various other programmes have seen a combined organic participation of over 3.5 crore people, making it a true People’s Movement.</p>
                            <p>The Fit India Dialogue, which will see participation of fitness enthusiasts from all over the country, further strengthens the vision that it is the citizens who are to be credited for the success of the nationwide movement.</p>    
                           <p>Anyone can join the Fit India Dialogue over the NIC link, <a href="https://pmindiawebcast.nic.in" style="color:#ff6600">https://pmindiawebcast.nic.in</a> from 11.30 noon on September 24.</p>
                         
                        </div>
                      
                    </div>

                    <div class="row et_pb_row_2">
                        <div class="col-sm-3 ">
                            <img src="{{ asset('resources/imgs/PR-soman1.jpg') }}" alt="about-fitindia" class="img-fluid"/>
                        </div>
                        <div class="col-sm-3 ">
                            <img src="{{ asset('resources/imgs/PR-Rujuta.jpg') }}" alt="about-fitindia" class="img-fluid"/>
                        </div>
                        <div class="col-sm-3 ">
                            <img src="{{ asset('resources/imgs/PR-Kohli.jpg') }}" alt="about-fitindia" class="img-fluid"/>
                        </div>
                        <div class="col-sm-3 ">
                            <img src="{{ asset('resources/imgs/PR-jhajharia.jpg') }}" alt="about-fitindia" class="img-fluid"/>
                        </div>
                        
                    </div>

                    <br>
                    
                    <div class="row et_pb_row_2 et_pb_row_3 justify-content-center">
                        <a href="https://www.youtube.com/watch?v=-2KOBfo9rm0&amp;t=1s" target="_blank">
                        <div class="col-sm-12 col-md-8 col-lg-8 pull-md-4 pull-lg-4 " style="margin:0 auto;">
                            <img src="{{ asset('resources/imgs/v-cover.jpg') }}" alt="about-fitindia" class="img-fluid"/>
                        </div>
                        </a>
                        <p style="padding:10px;">PM Sh. Narendra Modi’s interaction with fitness icons on Fit India Dialogue</p>
                    </div>
                   
                </div>
            </section>
        </div>


@endsection
