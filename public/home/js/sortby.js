$(function() {   
      $('#sortBy').bind('change', function() {  
    var url      = window.location.href;
          url = replaceUrlParam(url, 'sortby', $(this).val());  
    window.location.href = url;   
      });
   $('.switch-view').bind('click',function(){
     var url      = window.location.href;
            url = replaceUrlParam(url, 'view', $(this).data('view'));
     window.location.href = url;
   });
   function replaceUrlParam(url, paramName, paramValue) {
  var pattern = new RegExp('('+paramName+'=).*?(&|$)'),
   newUrl = url.replace(pattern,'$1' + paramValue + '$2');
  if ( newUrl == url ) {
   newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
  }
  return newUrl;
 }
});