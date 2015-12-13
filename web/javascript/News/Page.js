function searchTag(tag)
{
    window.location = "../Search.aspx?" + $.param({ Key: tag });
}
function initPage()
{
    $("#A2").addClass("topAct");
    $("#A1,#A3,#A4,#A5").addClass("topNor").hover(
    function () { $(this).removeClass("topNor").addClass("topAct"); },
    function () { $(this).removeClass("topAct").addClass("topNor"); });
    $(".r_print,.r_click,.spTag").hover(
    function () { $(this).css("text-decoration", "underline").css("cursor", "pointer"); },
    function () { $(this).css("text-decoration", "none").css("cursor", "default"); });
    var id = $("#NID").val();
    var pn = $("#PN").val();
    if (id != "" && pn == "1")
    {
        $.ajax({
            type: "POST",
            url: "../VisitProcess.aspx",
            data: "ID=" + id,
            error: function (){},
            success: function (data){}
        });
    }
}
$(function () { initPage(); });