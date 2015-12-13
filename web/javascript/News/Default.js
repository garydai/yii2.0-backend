function getStrLength(s, m) { var res = {}; res.O = s.length; res.Q = s.replace(/[^\x00-\xff]/g, "**").length; res.L = 0; var l = 0; for (var i = 0; i < res.O; i++) { if (s.substr(i, 1).charCodeAt(0) < 299) { l++; } else { l += 2; } if (l > m) { break; } else { res.L++; } } return res; }
function searchTags(tag)
{
    window.location = "Search.aspx?" + $.param({ Key: tag });
}
function searchKey()
{
    var val = $.trim($("#SchIpt").val());
    if (val == "请输入关键字...")
    {
        $("#SchIpt").focus();
        return;
    }
    window.location = "Search.aspx?" + $.param({ Key: val });
}
function changePageNumber()
{
    var pns = $.trim($("#_Input").val());
    if (pns == ""){window.location = "Default.shtml";return;}
    var pn = 1;
    try{pn = Number(pns);}catch(e){pn = -1;}
    pn = isNaN(pn) || pn < 1 ? 1 : pn;
    $("#_Input").val(pn);
    var cur = Number($("#_Input").attr("curPN"));
    var max = Number($("#_Input").attr("maxPN"));
    if (pn != cur){pn = pn > max ? max : pn;window.location = pn == 1 ? "Default.shtml" : ("Default_" + (pn - 1) + ".shtml");}
}
function initPage()
{
    $("#A2").addClass("topAct");
    $("#A1,#A3,#A4,#A5").addClass("topNor").hover(
    function () { $(this).removeClass("topNor").addClass("topAct"); },
    function () { $(this).removeClass("topAct").addClass("topNor"); });
    $(".tagSpan, #TagsConDiv > span").hover(
    function () { $(this).css("text-decoration", "underline").css("cursor", "pointer"); },
    function () { $(this).css("text-decoration", "none").css("cursor", "default"); });
    $("#SchIpt").attr("title", "请输入不超过20个字符或10个汉字的关键字").tipTip({ activation: "focus", maxWidth: "200px", defaultPosition: "bottom" });
    $("#SchIpt").bind({
        focus: function ()
        {
            if ($.trim($(this).val()) == "请输入关键字...")
            {
                $(this).val("");
                $(this).removeClass("schIptNor").addClass("schIptAct");
            }
        },
        blur: function ()
        {
            if ($.trim($(this).val()) == "")
            {
                $(this).removeClass("schIptAct").addClass("schIptNor");
                $(this).val("请输入关键字...");
            }
        }
    });
    $("#SchIpt").bind($.browser.msie ? "propertychange" : "input", function () { var ml = $(this).attr("maxlength"); if (ml != undefined && Number(ml) > 0) { var va = $(this).val(); var ln = getStrLength(va, Number(ml)); if (ln.Q > Number(ml)) { $(this).val(va.substr(0, ln.L)); return false; } } });
    $("#SchBtn").hover(function () { $(this).removeClass("btnNor").addClass("btnAct"); }, function () { $(this).removeClass("btnAct").addClass("btnNor"); });
    $("#SchBtn").bind("click", function () { searchKey(); });
}
$(function () { initPage(); });