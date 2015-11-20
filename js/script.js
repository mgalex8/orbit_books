$(document).ready(function(){
    $('.bookmark-link').click(function()
    {
        var thisTag = this;
        var bookmarkType = $(this).data('type');
        var itemId = $(this).data('itemid');
    
        if ($(this).hasClass('add-bookmark'))
        {        
            $.post('/profile/addbookmark/', {
                itemid: itemId,
                type: bookmarkType,
            }, function(response){
                console.log(response);
                $(thisTag).removeClass('add-bookmark');
                $(thisTag).addClass('delete-bookmark');            
                $(thisTag).prev().removeClass('fa-star-o'); 
                $(thisTag).prev().addClass('fa-star');                       
            }, 'JSON');
        }
        else if ($(this).hasClass('delete-bookmark'))
        {
            $.post('/profile/deletebookmark/', {
            itemid: itemId,
            type: bookmarkType,
            }, function(response){
                console.log(response);
                $(thisTag).removeClass('delete-bookmark');
                $(thisTag).addClass('add-bookmark');
                $(thisTag).prev().removeClass('fa-star');
                $(thisTag).prev().addClass('fa-star-o');            
            }, 'JSON');
        }
        return false;
    });
    
})