function debounce(func, wait) {
    var timeout;

    return function() {
        var context = this,
        args = arguments;

        var executeFunction = function() {
            func.apply(context, args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(executeFunction, wait);
    };
};
function autocomplete(elm,val,data) {
    closeAllLists();
    a = document.createElement("DIV");
    a.setAttribute("id", elm[0].id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    elm[0].parentNode.appendChild(a);
    for (i = 0; i < data.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (data[i].name.search(val) >= 0) {

            var st = data[i].name.search(val);
            var en = val.length;

            var t1 = data[i].name.substr(0, st);
            var t2 = data[i].name.substr(st, en);
            var t3 = data[i].name.substr(en+st);
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML += t1;
            b.innerHTML += "<strong>" + t2 + "</strong>";
            b.innerHTML += t3;
            b.innerHTML += '&#160;<strong>( '+data[i].iso+' )</strong>';
            if (data[i].flag) {
                b.innerHTML += '&#160;<img src="'+data[i].flag+'" width="30px" >';
            }
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' id='"+ data[i].id +"' value='" + data[i].name + "' flag='" +data[i].flag+ "' callingcode='" + data[i].phonecode + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            
        }else{
            b = document.createElement("DIV");
            b.innerHTML += data[i].name;
            b.innerHTML += '&#160;<strong>( '+data[i].iso+' )</strong>';
            if (data[i].flag) {
                b.innerHTML += '&#160;<img src="'+data[i].flag+'" width="30px" >';
            }
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' id='"+ data[i].id +"' value='" + data[i].name + "' flag='" +data[i].flag+ "' callingcode='" + data[i].phonecode + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
        }
        b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            elm[0].value = this.getElementsByTagName("input")[0].value;
            elm[0].setAttribute("data-id", this.getElementsByTagName("input")[0].getAttribute('id'));
            if (elm[0].name == 'country') {
                this.getElementsByTagName("input")[0].getAttribute('callingcode').length > 3 ?  document.getElementsByClassName('code_calling')[0].classList.add('has-more-characters') : '';
                document.getElementsByClassName('code_calling')[0].innerHTML = '(+'+this.getElementsByTagName("input")[0].getAttribute('callingcode')+')';
                document.getElementsByClassName('flag-in-field')[0].setAttribute('src',this.getElementsByTagName("input")[0].getAttribute('flag'));
                document.getElementsByClassName('flag-in-field')[0].classList.remove("d-none");
            }
            /* use searching for page search */
            if (elm[0].name == 'searching') {
                var id = this.getElementsByTagName("input")[0].getAttribute('id');
                $.ajax({
                    url: window.public_url+'searching',
                    type: 'POST',
                    data: {id: id,_token:window.token},
                })
                .done(function(data) {
                    $('.tab-content').html(data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            }
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        a.appendChild(b);
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != elm[0]) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}