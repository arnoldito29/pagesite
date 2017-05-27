$("#modalBooking-trip-info").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load(link.data("href"));
});

$("#modalBooking").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load(link.data("href"));
});

$("#modalBooking-check-number").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load(link.data("href"));
});

$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load(link.attr("href"));
});

$('#modalBooking-trip-info').on('hidden.bs.modal', function(e) { 
    $(this).removeData();
}) ;

$("#modalRequest-of-a-ride").on("show.bs.modal", function(e) {
    
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load( link.data('href'), function(){
        
        ride.initMap( 'popup_from' );
        ride.initMap( 'popup_to' );
        copyToRequest();
    });
});