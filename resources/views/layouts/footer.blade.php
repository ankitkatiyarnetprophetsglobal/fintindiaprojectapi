

<!-- Footer -->
<footer class="footer"  id="footer_ab" > 
        <div class="footer_flex-top">




           <div class="inner_footer">
             <ul class="f_link">
               <li><a href="#a" >Site Map</a></li>
               <li><a href="#a" >Feedback</a></li>
               <li><a href="#a" >Help</a></li>
               <li><a href="#a" >WIM</a></li>
               <li><a href="#a" >Contact Us</a></li>
               <li><a href="#a" >Privacy Policy</a></li>
             </ul>

             <ul class="s_link">
                <li>
                     <a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li> 
                <li>
                <a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                <a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </li>
                <li>
                <a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>

              
               
            </ul>

           </div>
           <!-- <div class="footer_link">
               
          </div>  -->

          <!-- <div class="footer_link">
              <ul>
                <li><div class="visitor">
                          <span class="social_area"> 
                            <span><a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a> </span>                   
                            <span><a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                            <span><a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></span>
                            <span><a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
                          </span>
                    </div>
                  </li>
              
               
            </ul>
          </div>         -->
          </div>
          <div class="clear"></div>
        <div id="main-footer">
            <div class="footer_Flex">
                    
                      
                 <p>© 2021 Sports Authority of India. All rights reserved </p><!--| <span class="pvpol">
                  <a href="{{ asset('wp-content/uploads/2021/01/Revised-Policy.pdf') }}" target="_blank">Privacy Policy &nbsp;</a>
                </span>-->
                 <p>Last updated on February 1st, 2021 | No of Visitors: <span>43091373</span></p> 
               
             
                  
                
  
              </div> 
                       
          </div>
     <div class="announcement-ticker">
    <div class="ticker-heading"><span>Announcements</span></div>
    <div class="ticker-txt ticker-wrap">
      <marquee id="mymarquee" scrollamount="5">
        <span><a href="covid-19-info">Covid-19 Info - Click Here</a> </span> 
        <span class="mid-line"></span>
        @if(!empty($announcement))
          @foreach($announcement as $ann)
            <span><a href="home" target="_blank">{{ $ann->title }}</a> </span>
            <span class="mid-line"></span> 
          @endforeach
        @endif 
      </marquee>
    </div>
  </div>

          
<script src="{{ asset('resources/js/bootstrap.min.js')}}"></script>
<script>

/*
------------------------------------------------------------
Function to activate form button to open the slider.
------------------------------------------------------------
*/
function open_panel() {
slideIt();
var a = document.getElementById("sidebar");
a.setAttribute("id", "sidebar1");
a.setAttribute("onclick", "close_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (open form)
------------------------------------------------------------
*/
function slideIt() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 95;
if (parseInt(slidingDiv.style.right) < stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) + 2 + "%";
setTimeout(slideIt, 1);
}
}
/*
------------------------------------------------------------
Function to activate form button to close the slider.
------------------------------------------------------------
*/
function close_panel() {
slideIn();
a = document.getElementById("sidebar1");
a.setAttribute("id", "sidebar");
a.setAttribute("onclick", "open_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (slide in form)
------------------------------------------------------------
*/
function slideIn() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 97;
if (parseInt(slidingDiv.style.right) > stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) - 2 + "%";
setTimeout(slideIn, 1);
}
}

function doModal(link) {
    html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
    html += '<div class="modal-dialog">';
  
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';

    html += '<h4>External site alert</h4>'
    html += '</div>';
    html += '<div class="modal-body">';
    html += 'This link shall take you to a webpage outside';
    html += ' ';
    html += link;
    html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
    html += '</div>';
    html += '<div class="modal-footer">';
    html += '<a target="_blank" href="';
    html += link;
    html +='"><span class="btn btn-primary btn_custyes  " >Yes</span></a>';
    html += '<span class="btn  btn_custno" data-dismiss="modal">No</span>';
    html += '</div>';  // content
    html += '</div>';  // dialog
    html += '</div>';  // footer
    html += '</div>';  // modalWindow
    $('body').append(html);
    $("#dynamicModal").modal();
    $("#dynamicModal").modal('show');


   

}

</script>
</footer>



