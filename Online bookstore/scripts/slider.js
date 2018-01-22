$(document).ready(function(){
    let index = 0; // starting with first slider
    let sliders = [];
    
    //fetching sliders from server
    $.ajax({
        url: "API.php?action=getSliders",
        dataType: "json"
    }).done(serverSliders => {
        $("#slider-container").empty();
        sliders = serverSliders;
        makeNewSlide();
    }).fail(error => console.log("Error when getting sliders", error)); 

    function makeNewSlide() {
        const sliderTemplate = $("#slider-template").html();
        const $sliderHtml = Mustache.render(sliderTemplate, sliders[index]); 
        $("#slider-container").html($sliderHtml);
        colorStars();
    };

    // marking stars based on saved grade
    function colorStars(){
        const $stars = $("#slider-container > #slider-image").find("#stars .fa");
        let grade = sliders[index].grade;
        for(let i=0; i<grade; i++) {
            $($stars[i]).removeClass("fa-star-o").addClass("fa-star");
        }
    };

    //changing empty stars into full ones
    $("#slider-container").on("click", "#stars .fa-star-o",(e) => {
        const clickedStar = e.currentTarget;
        const $stars = $("#slider-container > #slider-image").find("#stars .fa");
        let counter = $stars.index($(clickedStar));
        for(let i=0; i <= counter; i++) {
            $($stars[i]).removeClass("fa-star-o").addClass("fa-star");
        }
        
        const $image = $("#slider-container > #slider-image");
        const id = $image.attr("data-id");
        $.ajax({
		url:"API.php?action=changeGrade",
		data: {id: id,
              grade: counter+1},
		dataType: "json"
	   }).done(response => {
	   }).fail(error => console.log("Error when changing grade", error));        
        
        sliders[index].grade = counter+1;
    }); 

    //changing full stars into empty ones
    $("#slider-container").on("click", "#stars .fa-star",(e) => {
        const clickedStar = e.currentTarget;
        const $stars = $("#slider-container > #slider-image").find("#stars .fa");
        let counter = $stars.index($(clickedStar));
        for(let i=counter+1; i<5; i++) {
            $($stars[i]).removeClass("fa-star").addClass("fa-star-o");
        }
        
        const $image = $("#slider-container > #slider-image");
        const id = $image.attr("data-id");
        $.ajax({
		url:"API.php?action=changeGrade",
		data: {id: id,
              grade: counter+1},
		dataType: "json"
	   }).done(response => {
	   }).fail(error => console.log("Error when changing grade", error)); 
        
        sliders[index].grade = counter+1;
    }); 

    // click on right arrow
    $("#slider-container").on("click", ".arrow-icon-right",() => {
        index++;
        if(index > 2) index=0;
        makeNewSlide();
    });

    // click on left arrow
    $("#slider-container").on("click", ".arrow-icon-left",() => {
        index--;
        if(index < 0) index=2;
        makeNewSlide();
    });

    //click on "edit button" 
    $("#slider-container").on("click", "#edit", (e) => {
        const currentDesc = $("#slider-container > #slider-description > p").text();
        const description = prompt("New description text", currentDesc);
        if(!description) return;
        $("#slider-container > #slider-description > p").text(description);
        sliders[index].sliderText = description;
    });    
});
