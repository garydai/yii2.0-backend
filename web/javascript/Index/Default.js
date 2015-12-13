function searchTag(key)
{
    window.location = "News/Search.aspx?" + $.param({ Key: key });
}
function preProcessImage()
{
    $("#ImgDiv span").each(function ()
    {
        srcArr.push($(this).attr("IM"));
        desArr.push($(this).attr("HM"));
        nameArr.push($(this).attr("NM"));
    });
    for (var i = 0; i < srcArr.length; i++)
    {
        finish.push("0");
    }
    for (var k = 0; k < srcArr.length; k++)
    {
        img.push(new Image());
        img[k].src = srcArr[k];
    }
}
function changeImg()
{
    if (ready == false)
    {
        if (img == null || img.length == 0)
        {
            return;
        }
        for (var i = 0; i < img.length; i++)
        {
            if (img[i].complete != true)
            {
                return;
            }
        }
        ready = true;
    }
    var sp = 0;
    var has = "|";
    var temp = new Array();
    while (sp < 7)
    {
        var cc = Math.floor((img.length) * Math.random());
        cc == cc < 0 ? 0 : cc;
        cc == cc > (img.length - 1) ? (img.length - 1) : cc;
        if (has.indexOf("|" + cc + "|") >= 0)
        {
            continue;
        }
        has += cc + "|";
        temp.push(cc);
        sp++;
    }
    //
    var s = "<div id='IMF" + idx + "' class='imageflow'>";
    for (var i = 0; i < temp.length; i++)
    {
        s += "<img src='" + srcArr[temp[i]] + "' longdesc='" + desArr[temp[i]] + "' width='380' height='400' alt='" + nameArr[temp[i]] + "' />"
    }
    s += "</div>";

    $("#LoopDiv").html(s);
    domReady(function ()
    {
        var instanceOne = new ImageFlow();
        instanceOne.init({ ImageFlowID: 'IMF' + idx,
            captions: false,
            slider: false,
            startID: 4
        });
    });
    idx++;
}
function init()
{
    $("#A1").addClass("topAct");
    $("#A2,#A3,#A4,#A5").addClass("topNor").hover(
    function () { $(this).removeClass("topNor").addClass("topAct"); },
    function () { $(this).removeClass("topAct").addClass("topNor"); });
//    $f("Player", "Javascript/Flv/flowplayer.swf", {
//        clip: {
//            autoPlay: true,
//            autoBuffering: true
//        }
//    });
   // $(".starImg").tipTip({ maxWidth: "200px", defaultPosition: "bottom" });
    $(".starDiv").hover(
    function () { $(this).css("border", "solid 1px #B30B17").css("cursor", "pointer"); },
    function () { $(this).css("border", "solid 1px #ECECEC").css("cursor", "pointer"); });
    $(".newsTg").hover(
    function () { $(this).css("text-decoration", "underline").css("cursor", "pointer"); },
    function () { $(this).css("text-decoration", "none").css("cursor", "default"); });
//    preProcessImage();
    //    setInterval(changeImg, 30000);

    $("#CHBtn").bind("mouseover", function () { setDisplayCH(); });
    $("#ENBtn").bind("mouseover", function () { setDisplayEN(); });
}
function setDisplayCH()
{
    if (disEN)
    {
        $("#ENBtn").removeClass("lanActive").addClass("lanNormal");
        $("#CHBtn").removeClass("lanNormal").addClass("lanActive");
        $("#ENText").hide();
        $("#CHText").show();
        disEN = false;
    }
}
function setDisplayEN()
{
    if (disEN == false)
    {
        $("#CHBtn").removeClass("lanActive").addClass("lanNormal");
        $("#ENBtn").removeClass("lanNormal").addClass("lanActive");
        $("#CHText").hide();
        $("#ENText").show();
        disEN = true;
    }
}
var disEN = false;
var idx = 0;
var ready = false;
var srcArr = new Array();
var desArr = new Array();
var nameArr = new Array();
var img = new Array();
var finish = new Array();
$(function () { init(); });