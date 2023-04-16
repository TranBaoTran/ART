<div class="slideshow-container" style="z-index: -2;">
            <div class="mySlides fade">
            <div class="numbertext">1 / 4</div>
            <img src="img/qc2.png" style="width:100%">
            </div>
            <div class="mySlides fade">
            <div class="numbertext">2 / 4</div>
            <img src="img/qc3.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <img src="img/qc4.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <img src="img/qc5.jpg" style="width:100%">
            </div>   
        </div>
        <br>
        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>
        <script>
        let slideIndex = 0;
        showSlides();
        
        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 2000); 
        }
</script>