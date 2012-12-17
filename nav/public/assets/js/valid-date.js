function validDate(date)
{
    var pattern = /^(\d{4}(-\d{2}){2} (\d{2})(:\d{2}){2})$/;

   // alert(date.match(pattern));

    if(date.match(pattern)){return true;}
    else{return false;}
}
