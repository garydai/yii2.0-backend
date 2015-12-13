function init()
{
    $("#A3").addClass("topAct");
    $("#A1,#A2,#A4,#A5").addClass("topNor").hover(
    function () { $(this).removeClass("topNor").addClass("topAct"); },
    function () { $(this).removeClass("topAct").addClass("topNor"); });
}
$(function () { init(); });