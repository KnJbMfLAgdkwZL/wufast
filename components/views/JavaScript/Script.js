GlobalAction = '';
GlobalID = 0;
function CreateDrop()
{    
    data = document.forms['order'];
    data.style.display = "inherit";
    Hidenn = document.getElementById("Hidenn");
    Hidenn.style.display = "table";
    data['action'].value = 'AdminCreateDrop';
    data['country'].value = 'Russia';
    data['city'].value = 'Moscow';
    GlobalAction = 'DropEdit';
}
function GetRandomPassword(id)
{
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 8;
    var randomstring = '';
    for (var i=0; i<string_length; i++)
    {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
    data = document.forms['editusers'];  
    data["password" + id].value = randomstring;
}
function ClientTimerChatStart(id)
{
    GlobalID = id;
    var interval = setInterval(GetNewMessages, 5000);
}
function AdminLookTicket(id)
{
    GlobalAction = 'AdminLookTicket';
    str = 'action=AdminAction'
    + '&id=' + id
    + '&AdAction=AdminLookTicket';
    SendData(str);
}
function ClientCloseNews(id)
{
    GlobalAction = 'ClientCloseNews';
    str = 'action=ClientAction&ClAction=ClientCloseNews&id=' + id;
    SendData(str);
}
function GetNewMessages()
{
    GlobalAction = 'GetNewMessages';
    str = 'action=GetNewMessages&id=' + GlobalID;
    SendData(str);
}
function  ClientSendTickets(id)
{
    GlobalAction = 'ClientSendTickets';
    data = document.forms['SendTicketForm'];
    str = 'action=ClientAction'
    + '&id=' + id
    + '&ClAction=ClientSendTickets'
    + '&message='+ data['message'].value;
    data['message'].value = '';
    SendData(str);
}
function  AdminSendTickets(id)
{
    GlobalAction = 'AdminSendTickets';
    data = document.forms['SendTicketForm'];
    str = 'action=AdminAction'
    + '&id=' + id
    + '&AdAction=AdminSendTickets'
    + '&message='+ data['message'].value;
    data['message'].value = '';
    SendData(str);
}
function ClientEdit(iddrop)
{
    data = document.forms['order'];
    data.style.display = "inherit";
    Hidenn = document.getElementById("Hidenn");
    Hidenn.style.display = "table";
    DOmtcn = document.getElementById("DOmtcn" + iddrop);
    DOcountry = document.getElementById("DOcountry" + iddrop);
    DOname = document.getElementById("DOname" + iddrop);
    DOamount = document.getElementById("DOamount" + iddrop);
    DOcurcy = document.getElementById("DOcurcy" + iddrop);
    DOcomt = document.getElementById("DOcomt" + iddrop);
    dropinfo = document.getElementById("dropinfo" + iddrop);
    valueorderform = document.getElementById("valueorderform");
    valueorderform.innerHTML = dropinfo.innerHTML;
    data['OrderId'].value = iddrop;
    data['mtcn'].value = DOmtcn.innerHTML;
    data['country'].value = DOcountry.innerHTML;
    data['name'].value = DOname.innerHTML;
    data['amount'].value = DOamount.innerHTML;
    data['currency'].value = DOcurcy.innerHTML;
    data['comment'].value = DOcomt.innerHTML;
    GlobalAction = 'ClientEdit';
}
function ClientCansel(iddrop)
{
    GlobalAction = 'ClientEdit';
    data = document.forms['order'];
    data['OrderId'].value = iddrop;
    OKclick('OrderDelete');
}
function Hide(btn)
{
    Hidenn = document.getElementById("Hidenn");
    Hidenn.style.display = "none";
    data = document.forms['order'];
    id = data['OrderId'].value;
    if(btn==false)
    {
        btn = document.getElementById('ordbtnid' + id);
        btn.style.display = "inherit";
    }
}
function DroprDelete(id)
{
    data = document.forms['order'];
    data['OrderId'].value = id;
    GlobalAction = 'DroprDelete';
    str = 'action=AdminAction' + '&id=' + id + '&AdAction=DroprDelete';
    SendData(str);
}
function ClientChangeCategory(cat)
{
    GlobalAction = 'ClientChangeCategory';
    str = 'action=ClientAction' + '&ClAction=ClientChangeCategory&cat=' + cat;
    SendData(str);
}
function AdminEditUser(id)
{
    GlobalAction = 'AdminEditUser';
    data = document.forms['editusers'];
    str = 'action=AdminAction&AdAction=AdminEditUser&id=' + id + 
    '&nickname=' + data["nickname" + id].value + 
    '&password=' + data["password" + id].value +
    '&group=' + data["group" + id].value +
    '&delete=' + data["delete" + id].checked;
    SendData(str);
}
function DroprEdit(id)
{
    data = document.forms['order'];
    data.style.display = "inherit";
    Hidenn = document.getElementById("Hidenn");
    Hidenn.style.display = "table";
    tdname = document.getElementById("tdname" + id)
    tdcountry = document.getElementById("tdcountry" + id)
    tdcity = document.getElementById("tdcity" + id)
    tdcat = document.getElementById("cat" + id)
    data['name'].value = tdname.innerHTML;
    data['country'].value = tdcountry.innerHTML;
    data['city'].value = tdcity.innerHTML;
    data['cat'].value = tdcat.value;
    data['OrderId'].value = id;
    GlobalAction = 'DropEdit';
}
function DroprEditOKclick(action)
{
    data = document.forms['order'];
    data['category'].value = data['cat'].value;
    var mylist = ['mtcn', 'country', 'name', 'amount', 'comment'];
    data = document.forms['order'];
    id = data['OrderId'].value;
    str = 'action=AdminAction' + '&id=' + id + '&AdAction=' + action + '&';
    for(i=0; i<data.length; i++)
    {
        str += data[i].name + "=" + data[i].value;
        if(i < data.length-1)
            str += "&";
        if(mylist.indexOf(data[i].name)!=-1)
            data[i].value = '';
    }
    Hide(true);
    SendData(str);
}

function Order(id)
{
    btn = document.getElementById('ordbtnid' + id);
    btn.style.display = "none";
    tdname = document.getElementById('tdname' + id);
    tdcountry = document.getElementById('tdcountry' + id);
    tdcity = document.getElementById('tdcity' + id);
    val = document.getElementById('valueorderform');
    val.innerHTML = tdname.innerHTML + ', ' + tdcountry.innerHTML + ', ' + tdcity.innerHTML;
    data = document.forms['order'];
    data['OrderId'].value = id;
    data.style.display = "inherit";
    Hidenn = document.getElementById("Hidenn");
    Hidenn.style.display = "table";
}
function OKclick(action)
{
    var mylist = ['mtcn', 'country', 'name', 'amount', 'comment'];
    data = document.forms['order'];
    id = data['OrderId'].value;
    str = 'action=ClientAction' + '&id=' + id + '&ClAction=' + action + '&';
    for(i=0; i<data.length; i++)
    {
        str += data[i].name + "=" + data[i].value;
        if(i < data.length-1)
            str += "&";
        if(mylist.indexOf(data[i].name)!=-1)
            data[i].value = '';
    }
    Hide(true);
    SendData(str);
}
function OpOk(id)
{
    itemid = id;
    str = 'action=OperatorAction' + '&id=' + id + '&OpAction=clickOk';
    SendData(str);
}
function OpCans(id)
{
    itemid = id;
    str = 'action=OperatorAction' + '&id=' + id + '&OpAction=clickCans';
    SendData(str);
}
function SendData(data)
{
    sender = GetXmlHttpRequest();
    sender.onreadystatechange = GetRequest;
    sender.open("POST", "");
    sender.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    sender.send(data);
}
function GetRequest()
{
    if(sender.readyState == 4)
    {
        if (sender.status == 200)
        {
            str = sender.responseText;
            if(str.length > 0)
            {
                if(GlobalAction == 'ClientEdit' || GlobalAction == 'DropEdit' ||
                    GlobalAction == 'DroprDelete' || GlobalAction == 'AdminEditUser' ||
                    GlobalAction == 'ClientChangeCategory' || GlobalAction == 'AdminLookTicket' || 
                    GlobalAction == 'ClientCloseNews')
                {
                    if(str.length > 0)
                    {
                        document.documentElement.innerHTML = str;
                    }
                }
                else if(GlobalAction == 'ClientSendTickets' || GlobalAction == 'GetNewMessages' ||
                    GlobalAction == 'AdminSendTickets')
                {
                    if(str.length > 0)
                    {
                        obj = document.getElementById('messages');
                        obj.innerHTML = str;
                    }
                }
                else
                {
                    obj = document.getElementById('status' + itemid);
                    obj.innerHTML = str;
                }
            }
        }
    }
}
function GetXmlHttpRequest()
{
    var XMLHttp;
    try
    {
        XMLHttp = new XMLHttpRequest();
    }
    catch(e)
    {
        try
        {
            XMLHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try
            {
                XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                alert("Your browser broke!");
                return false;
            }
        }
    }
    return XMLHttp;
}