$(document).ready(function(){
    let thumbnails = []; 
    
    //dohvacanje thumbnaila sa servera
    $.ajax({
        url: "API.php?action=getThumbnails",
        dataType: "json"
    }).done(serverThumbnails => {
        $("#thumbnails-container").empty();
        thumbnails = serverThumbnails;
        thumbnails.forEach(thumbnail => createThumbnail(thumbnail));
    }).fail(error => console.log("Error when getting cards", error)); 

    function createThumbnail(thumbnail) {
        const thumbnailTemplate = $("#thumbnail-template").html();
        const thumbnailHtml = Mustache.render(thumbnailTemplate, thumbnail);
        $("#thumbnails-container").append(thumbnailHtml);
    };

    //dodavanje thumbnaila 
    $("#add-button").on("click", e => {
        const imageUrl = prompt("Enter image URL", "images/the-whistler.jpg");
        if(!imageUrl) {return; }

        const title = prompt("Enter title", "The Whisteler");
        if(!title) {return; }

        const desc = prompt("Enter description", `Lacy Stoltz is an investigator for the Florida Board on Judicial Conduct.
                            She is a lawyer, not a cop, and it is her job to respond to complaints dealing with judicial misconduct.`);
        if(!desc) {return; }

        const thumbnail = {
            title: title,
            imageUrl: imageUrl
        };
        
        $.ajax({
            url:"API.php?action=addThumbnail",
            data: thumbnail,
            dataType: "json"
        }).done(response => {   // response je ID
            thumbnail.id=response.id;
            thumbnails.push(thumbnail);
            createThumbnail(thumbnail);
        }).fail(error => console.log("Error when adding card", error));
    });

    // brisanje thumbnaila
    $("#thumbnails-container").on("click", ".thumbnail .delete-button", (e) => {
        const deleteButton = e.currentTarget;
        const $card = $(deleteButton).parent(".thumbnail");
        $card.fadeOut(() => $card.remove());
    }); 
});