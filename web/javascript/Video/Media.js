function setStarVdo(sid, vid)
{
    $("#TitDiv").hide();
    setVideo(vid, sid);
}
function setVideo(vid, sid)
{
    $f().stop();
    $("#InfoDiv,#VideoDiv").hide();
    $("#LoadDiv").show();
    $.ajax({
        type: "POST",
        url: "GetInfo.aspx",
        data: "ID=" + vid + "&SI=" + sid,
        error: function () { openVideo(); },
        success: function (data) { resetVideo(data, vid); }
    });
    setVisit(vid);
}
function openVideo()
{
    $("#LoadDiv").hide();
    if ($("#P_ID").val() == "" || $("#P_ID").val() == null)
    {
        $("#InfoDiv").hide();
    }
    else
    {
        $("#InfoDiv").show();
    }
    $("#VideoDiv").show();
    $f().play();
}
//function imgLoad()
//{
//    if (isCheck)
//    {
//        openVideo();
//        isCheck = false;
//    }
//}
function resetVideo(info, vid)
{
    if (info == "" || info == null || info == undefined)
    {
        openVideo();
    }
    else
    {
        var data = info.split("%HbsbH%");
        $("#P_ID").val(vid);
//        $("#P_Link").attr("href", data[2] == null || data[2] == "" || data[2] == "null" ? "javascript:void(0);" : data[2]);
//        isCheck = true;
//        $("#P_Ava").attr("src", data[0]);
//        $("#P_Ava").attr("alt", data[1]);
//        $("#P_Ava").attr("title", data[1]);
        $("#P_LinkS").attr("href", data[2] == null || data[2] == "" || data[2] == "null" ? "javascript:void(0);" : data[2]);
        $("#P_Name").html(data[1]);
//        $("#P_Title").html(data[3]);
        $("#Player").attr("href", vid != "0" ? data[4] : defVdo);
        $f("Player", "../Javascript/Flv/flowplayer.swf", {
            clip: {
                autoPlay: false,
                autoBuffering: true
            }
        });
        openVideo();
    }
}
function setVisit(id)
{
    $.ajax({
        type: "POST",
        url: "VisitProcess.aspx",
        data: "ID=" + id,
        error: function () { },
        success: function (data) { }
    });
}
function init()
{
    $("#A4").addClass("topAct");
    $("#A1,#A2,#A3,#A5").addClass("topNor").hover(
    function () { $(this).removeClass("topNor").addClass("topAct"); },
    function () { $(this).removeClass("topAct").addClass("topNor"); });
    $f("Player", "../Javascript/Flv/flowplayer.swf", {
        clip: {
            autoPlay: false,
            autoBuffering: true
        }
    });
    $.ajax({
        type: "POST",
        url: "GetRmd.aspx",
        data: null,
        error: function ()
        {
            $("#LoadDiv,#InfoDiv").hide();
            $("#TitDiv,#VideoDiv").show();
            $f().play();
        },
        success: function (data)
        {
            if (data == null || data == "")
            {
                $("#LoadDiv,#InfoDiv").hide();
                $("#TitDiv,#VideoDiv").show();
                $f().play();
            }
            else
            {
                var cc = data.split("|");
                setStarVdo(cc[0], cc[1]);
            }
        }
    });
    $(".spanLinkNor").hover(function () { $(this).addClass("spanLinkAct"); }, function () { $(this).removeClass("spanLinkAct"); });
//    $("#P_Ava").bind("load", function () { imgLoad(); });
}
//var isCheck = false;
var defVdo = "../Images/Default/null.flv";
$(function () { init(); });