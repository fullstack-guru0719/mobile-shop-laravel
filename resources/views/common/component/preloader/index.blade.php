
<style>
#preloader {
    position: fixed;
    /* top: 0; */
    left: 0;
    width: 80%;
    left: -3%;
    /* height: 100%; */
    z-index: 999999;
    /* background: #e0e0e0;
    opacity: 0.6; */
}
#loader {
    display: block;
    position: relative;
    /* left: 50%; */
    left: 45%;
    /* top: 10%; */
    width: 80px;
    height: 80px;
    /* margin: -75px 0 0 -75px; */
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #30C032;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}
#loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #8f6ed5;
    -webkit-animation: spin 3s linear infinite;
    animation: spin 3s linear infinite;
}
#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #2394F2;
    -webkit-animation: spin 1.5s linear infinite;
    animation: spin 1.5s linear infinite;
}
@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
.addOnPreloader {
    min-height: 80px;
}
</style>

<div id="preloader" class="pb50">
    <div id="loader"></div>
</div>
<div class="addOnPreloader"></div>