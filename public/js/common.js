function generateStars(el, numb , width = "12px" , isReadonly = true , isCustom = '' , rateFill = '#fcfc0d'){
    el.rateYo({
        rating: numb,
        starWidth: width,
        ratedFill: rateFill,
        normalFill: '#c5c9cc',
        spacing: '4px',
        fullStar: true,
        readOnly: isReadonly,
        starSvg: isCustom,
    });
}

//show errors in forms
function validateForm(form , event){
    if(form){
        if ($(form)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            $(form).addClass('was-validated');
        }
        else{
            $(form).removeClass('was-validated');
        }
    }
    $('.select-input-form:invalid').closest('.form-group').children('.invalid-feedback').css('display','block');
    $('.select-input-form:invalid').closest('.form-group').children('.select-input-container').css('border','1px solid #dc3545');

}

$(document).ready(function(){
    //change flag
    $('.dropdown-item').on('click',function(){
        let firstLink = $(this).closest('.dropdown').children(':first').attr('href');
        let firstImg = $(this).closest('.dropdown').children(':first').find('img').attr('src');
        let firstChild = $(this).closest('.dropdown-menu').children(':first');
        
        $(this).closest('.dropdown').children(':first').find('img').attr('src',$(this).find('img').attr('src'));
        $(this).closest('.dropdown').children(':first').attr('href',$(this).attr('href'));
        if($(this).closest('.dropdown-replace').length != 0){
            $(this).closest('.dropdown').children(':first').find('span').html($(this).find('.flag-container div:nth-child(2) , .country').html());
            firstChild.attr('href',$(this).attr('href'));
            firstChild.find('img:not(".icon")').attr('src',$(this).find('img').attr('src'));
            firstChild.find('.flag-container div:nth-child(2), .country').html($(this).find('.flag-container div:nth-child(2) , .country').html());
        }
        else{
            $(this).find('img').attr('src', firstImg);
            $(this).attr('href', firstLink);
        }
    });
    //single date not time
    $('input.single-date-not-time').daterangepicker({
        singleDatePicker: true,
        numberOfMonths: 2,
        showDropdowns: true,
        timePicker: false,
        minYear: 1880,
        locale: {
            format: 'YYYY/MM/DD'
        },
        autoUpdateInput: false,
    });
    
    $('input.single-date-not-time').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.endDate.format('YYYY/MM/DD'));
        $(this).val(picker.startDate.format('YYYY/MM/DD'));
    })
    //single date
    var plustime = new Date();
    plustime.setMinutes( plustime.getMinutes() + 15 );
    $('input#begin_time').daterangepicker({
        singleDatePicker: true,
        numberOfMonths: 2,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        minYear: 1880,
        locale: {
            format: 'YYYY/MM/DD H:mm'
        },
        autoUpdateInput: false,
        minDate: plustime,
    });
    
    $('input#begin_time').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.endDate.format('YYYY/MM/DD H:mm'));
        var d = new Date(picker.endDate.format('YYYY/MM/DD H:mm'));
        $('input#arrival_time').daterangepicker({
            singleDatePicker: true,
            numberOfMonths: 2,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            minYear: 1880,
            locale: {
                format: 'YYYY/MM/DD H:mm'
            },
            autoUpdateInput: false,
            minDate: d,
        });
    })

    $('input#arrival_time').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD H:mm'));
    })

    //open/close sidebar
    $('.open-nav').on('click',function(){
        $('body').addClass('open-sidebar');
        $('body').append('<div class="warpper-z"></div>')
    });
    $('body').on('click','.icon-close', function(){
        $('body').removeClass('open-sidebar');
        $('body').find('.warpper-z').remove();
    });
    $('body').on('click','.warpper-z', function(){
        $('body').removeClass('open-sidebar');
        $('body').find('.warpper-z').remove();
    });

    $(".navbar-tools").on('click','.show',function(event) {
        $(this).addClass('hide fa-times').removeClass('show fa-search');
        $( ".navbar-search" ).animate({
            width: "60%",
            opacity: 1,
        }, 1000);
    });
    $(".navbar-tools").on('click','.hide',function(event) {
        $(this).addClass('show fa-search').removeClass('hide fa-times');
        $( ".navbar-search" ).animate({
            width: "0%",
            opacity: 0,
        }, 1000);
    });

    //image upload
/*    $('input[name="avatar"]').on('change', function() {
        if (this.files && this.files[0]) {
            var img = $(this).closest('.input-image').find('img').removeClass('invisible').addClass('visible');
            //$(this).closest('.input-image').find('img').css('display','block');
            $(this).prev().css('background-color','white');
            img.attr('src', URL.createObjectURL(this.files[0]));
        }
    });

    $('input[name="idcard"]').on('change', function() {
        if (this.files && this.files[0]) {
            var img = $(this).closest('.input-idcard').find('img').removeClass('invisible').addClass('visible');
            //$(this).closest('.input-image').find('img').css('display','block');
            $(this).prev().css('background-color','white');
            img.attr('src', URL.createObjectURL(this.files[0]));
        }
    });*/
    
    //edit
    $('.edit-wrap').on('click',function(){
        $(this).closest('.form-group').find('input').prop('readonly',false);
    });

    //close modal
    $('.close-icon').on('click',function(){
        $(this).closest('.modal').modal('hide');
    });

    //form validation
    $('form').on('submit',function(event){
        validateForm(this , event);
    });

    $('.go-back').click(function(event) {
        window.history.back();
    });
    $( ".daterangepicker .ranges" ).click(function(event) {
        $('.daterangepicker').hide();
    });
    /* rating trip */
    var data_rating = $(".rate").attr('data');
    var $rateYo = $(".rate").rateYo({
        halfStar: true,
        rating: data_rating,
    }).on("rateyo.set", function (e, data) {
        var user_id = $(".rate").attr('user_id');
        if (user_id) {
            $.ajax({
                url: window.public_url+'rating',
                type: 'POST',
                data: {user_id: user_id,rating:data.rating,_token:window.token},
            })
            .done(function(data) {
                console.log(data);
            })
        }else{
            alert('You cannot rate this trip at the moment !');
            $rateYo.rateYo("destroy");
            $rateYo.rateYo({
                alfStar: true,
                rating: data_rating,
            });
        }
        
    });

 

})  
