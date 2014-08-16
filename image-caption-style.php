.image-caption-hover {
    margin: 5px 0;
}
.image-caption-hover .image-caption-box {   
    cursor: pointer;  
    height: 200px;
    position: relative;  
    overflow: hidden;  
    width: 100%;   
    background-color: #000;
}  
  
.image-caption-hover .image-caption-box img {  
    position: absolute;  
    left: 0;  
    -webkit-transition: all 300ms ease-out;  
    -moz-transition: all 300ms ease-out;  
    -o-transition: all 300ms ease-out;  
    -ms-transition: all 300ms ease-out;  
    transition: all 300ms ease-out;
    max-width: 100%;
} 

.image-caption-hover .image-caption-box .caption {  
    background-color: rgba(0,0,0,0.5);  
    position: absolute;  
    color: #fff;  
    z-index: 100;  
    -webkit-transition: all 300ms ease-out;  
    -moz-transition: all 300ms ease-out;  
    -o-transition: all 300ms ease-out;  
    -ms-transition: all 300ms ease-out;  
    transition: all 300ms ease-out;  
    height: 200px;
    text-align: center;
} 

/* Styles */
.image-caption-hover .image-caption-box .effect-1 {  
    height: 200px;  
    width: 100%;  
    display: block;  
    bottom: -100%;   
}

.image-caption-hover .image-caption-box:hover .effect-1 {  
    -moz-transform: translateY(-100%);  
    -o-transform: translateY(-100%);  
    -webkit-transform: translateY(-100%);  
    transform: translateY(-100%);  
} 

.image-caption-hover .image-caption-box .effect-2 {  
    height: 200px;  
    width: 100%;  
    display: block;  
    top: -100%;    
}

.image-caption-hover .image-caption-box:hover .effect-2 {  
    -moz-transform: translateY(100%);  
    -o-transform: translateY(100%);  
    -webkit-transform: translateY(100%);  
    transform: translateY(100%);  
} 

.image-caption-hover .image-caption-box .effect-3 {  
    width: 100%;  
    height: 200px;     
    left: 100%;  
}

.image-caption-hover .image-caption-box:hover .effect-3 {  
    background-color: rgba(0,0,0,0.9) !important;  
    -moz-transform: translateX(-100%);  
    -o-transform: translateX(-100%);  
    -webkit-transform: translateX(-100%);  
    opacity: 1;  
    transform: translateX(-100%);  
}

.image-caption-hover .image-caption-box .effect-4,
.image-caption-hover .image-caption-box .effect-4 p,
.image-caption-hover .image-caption-box .effect-4 h3,
.image-caption-hover .image-caption-box .effect-4 a { 
    display: block; 
    left: -100%;  
    width: 100%;  
    -webkit-transition: all 300ms ease-out;  
    -moz-transition: all 300ms ease-out;  
    -o-transition: all 300ms ease-out;  
    -ms-transition: all 300ms ease-out;  
    transition: all 300ms ease-out;  
}  
  
.image-caption-hover .image-caption-box .effect-4 h3 {  
    -webkit-transition-delay: 400ms;  
    -moz-transition-delay: 400ms;  
    -o-transition-delay: 400ms;  
    -ms-transition-delay: 400ms;  
    transition-delay: 400ms;  
}  
  
.image-caption-hover .image-caption-box .effect-4 p {  
    -webkit-transition-delay: 600ms;  
    -moz-transition-delay: 600ms;  
    -o-transition-delay: 600ms;  
    -ms-transition-delay: 600ms;  
    transition-delay: 600ms;  
}
.image-caption-hover .image-caption-box .effect-4 a {  
    -webkit-transition-delay: 800ms;  
    -moz-transition-delay: 800ms;  
    -o-transition-delay: 800ms;  
    -ms-transition-delay: 800ms;  
    transition-delay: 800ms;  
}

.image-caption-hover .image-caption-box:hover .effect-4 a,   
.image-caption-hover .image-caption-box:hover .effect-4 h3,  
.image-caption-hover .image-caption-box:hover .effect-4 p {  
    -moz-transform: translateX(100%);  
    -o-transform: translateX(100%);  
    -webkit-transform: translateX(100%);  
    transform: translateX(100%);  
}  