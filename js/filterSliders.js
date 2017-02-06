function sliderInit(sliderName) {
    var sliderWidth = document.getElementById(sliderName + '-slider').offsetWidth;
    var range = document.getElementById(sliderName + '-slider-range');
    
    var handleWidth = 16;
    var leftHandle = document.getElementById(sliderName + '-slider-left');
    var rightHandle = document.getElementById(sliderName + '-slider-right');
    
    var actualRange = sliderWidth - handleWidth;
    
    range.style.width = actualRange + 'px';
    range.style.left = handleWidth / 2 + 'px';
    
    leftHandle.style.left = '0px';
    rightHandle.style.left = sliderWidth - handleWidth + 'px';
}