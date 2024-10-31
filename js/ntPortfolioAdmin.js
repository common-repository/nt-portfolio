jQuery(function($){

  // Set all variables to be used in scope
  var frame,
      metaBox = $('#portfolio-image.postbox'), // Your meta box id here
      addImgLink = metaBox.find('.upload-custom-img'),
      delImgLink = metaBox.find( '.delete-custom-img'),
      imgContainer = metaBox.find( '.custom-img-container'),
      imgIdInput = metaBox.find( '.nt-portfolio-image' );
      inputCont = metaBox.find('.inside');
      delSingleImg =  metaBox.find( '.delete-single-img' );
  
  // ADD IMAGE LINK
  addImgLink.on( 'click', function( event ){
    
    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Select or Upload Media Of Your Chosen Persuasion',
      button: {
        text: 'Use this media'
      },
      multiple: true  // Set to true to allow multiple files to be selected
    });

    
    // When an image is selected in the media frame...
    frame.on( 'select', function() {
      
      // Get media attachment details from the frame state
      //var attachment = frame.state().get('selection').first().toJSON();

      var attachment = frame.state().get('selection').toJSON();

      for(var i=0;i<attachment.length;i++)
      {
        
        // Send the attachment URL to our custom image input field.
        imgContainer.append( '<img src="'+attachment[i].url+'" alt="" style="max-width:100%;"/>' );
        
        inputCont.append('<input class="nt-portfolio-image" name="nt-portfolio-image[]" type="hidden" value="'+attachment[i].id+'" />');
        imgContainer.append('<a class="delete-single-img" data-id="'+attachment[i].id+'" data-src="'+attachment[i].url+'" href="#"> Remove image</a>').on( 'click', function( event ){

        event.preventDefault();
        
        console.log("test "+jQuery(event.target).prev().attr('src'));
        if(jQuery(event.target).attr('data-src') == jQuery(event.target).prev().attr('src'))
        {
           inputCont.find("input[value=\""+jQuery(event.target).attr('data-id')+"\"]").remove();
           jQuery(event.target).prev().remove();
           jQuery(event.target).remove();
        }

        });

      }
    });

    frame.open();
  });
  
  
  // DELETE IMAGE LINK
  delImgLink.on( 'click', function( event ){

    event.preventDefault();

    // Clear out the preview image
    imgContainer.html( '' );

    // Un-hide the add image link
    //addImgLink.removeClass( 'hidden' );

    // Hide the delete image link
    //delImgLink.addClass( 'hidden' );

    // Delete the image id from the hidden input
    //imgIdInput.val( '' );
    metaBox.find('.nt-portfolio-image').remove();

  });

  delSingleImg.on( 'click', function( event ){

    event.preventDefault();
    
    if(jQuery(event.target).attr('data-src') == jQuery(event.target).prev().attr('src'))
    {
       inputCont.find("input[value=\""+jQuery(event.target).attr('data-id')+"\"]").remove();
       jQuery(event.target).prev().remove();
       jQuery(event.target).remove();
    }



  });

});