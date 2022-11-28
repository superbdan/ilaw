/*This functions is for the Slideshow in homepage*/
var myIndex = 0;
    carousel();
        function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
        }
        
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 5000); // Change image every 2 seconds
        }    
/*This functions is for the Owl Carousel*/    
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
                items : 6,
                itemsDesktop:[1199,4],
                itemsDesktopSmall:[980,3],
                itemsTablet : [800,2],
                itemsMobile : [600,1],
                pagination:false,
                navigation:true,
                navigationText:["",""],
                autoPlay:true
            });
            $("#news-slider2").owlCarousel({
                items : 6,
                itemsDesktop:[1199,4],
                itemsDesktopSmall:[980,3],
                itemsTablet : [800,2],
                itemsMobile : [600,1],
                pagination:false,
                navigation:true,
                navigationText:["",""],
                autoPlay:true
            });
        });
// This is for the PFOS Modal
        // Get the modal
        var modal = document.getElementById("myModal");
        
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var img2 = document.getElementById("myImg2");
        var img3 = document.getElementById("myImg3");
        var img4 = document.getElementById("myImg4");
        var img5 = document.getElementById("myImg5");
        var img6 = document.getElementById("myImg6");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        }
        img2.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img3.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img4.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img5.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img6.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
        modal.style.display = "none";
        }
        
        /*This is for the Burger Menu Button*/ 
        function toggleSidebar(){
            document.getElementById("menuList").classList.toggle('active')
            }

