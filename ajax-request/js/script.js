



jQuery(document).ready(function($) {
     $.ajax({
          url: academyAjax.ajax_url, 
          type: 'POST',
          data: {
               action: 'academy_ajax_get_posts',
               _ajax_nonce: academyAjax.ajax_nonce,    // Nonce part 
          },
          success: function(response) {
              if (Array.isArray(response)) {

               var html =  '<ul>';

               response.forEach(function(item) {

                         html += '<li>' + item.post_title + '</li>';

               });

                html +=  '</ul>';

                    $('.plugin_ajax_callback').append(html);
              }
               
          },
           
     });
});
