function RandomPassword()
{
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 8;
    var randomstring = '';
    for (var i=0; i<string_length; i++)
    {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
    modalform = document.forms['modalform'];
    modalform['password'].value = randomstring;
}
function ModalOpen()
{
    Hidenn = document.getElementsByClassName('modal');
    Hidenn = Hidenn[0];
    Hidenn.style.display = 'initial';
}
function ModalClose()
{
    Hidenn = document.getElementsByClassName('modal');
    Hidenn = Hidenn[0];
    Hidenn.style.display = "none";
    modalform = document.forms['modalform'];
    radio = true;
    for(i=0; i<modalform.length; i++)
    {
        if(modalform[i].name != '')
        {
            if(modalform[i].type == 'radio')
            {
                if(radio)
                {
                    modalform[i].checked = true;
                    radio = false;
                }
            }
            else if(modalform[i].type == 'text')
            {
                modalform[i].value = '';
            }
        }
    }
}
function EditUser(id)
{
    userdel = document.getElementById('userdel');
    userdel.style.display = 'initial';
    userdel.onclick = function() { AdminEditUser(id, 'del'); }
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = 'Редактировать Пользователя';
    Foot = document.getElementsByClassName('SaveBtn');
    Foot = Foot[0];
    Foot.innerHTML = 'Сохранить';
    Foot.onclick = function() { AdminEditUser(id, 'edit'); }
    modalform = document.forms['modalform'];
    modalform['login'].value = document.getElementById('nickname' + id).innerHTML;
    modalform['group'].value = document.getElementById('group' + id).innerHTML;
    GlobalAction = 'AdminEditUser';
    ModalOpen();
}

function CreateUser()
{
    userdel = document.getElementById('userdel');
    userdel.style.display = 'none';
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = 'Создать Пользователя';
    Foot = document.getElementsByClassName('SaveBtn');
    Foot = Foot[0];
    Foot.innerHTML = 'Создать';
    Foot.onclick = function() { AdminCreateUser(); }
    GlobalAction = 'AdminCreateUser';
    ModalOpen();
}
function AdminEditUser(id, type)
{
    modalform = document.forms['modalform'];
    str = 'action=AdminAction&AdAction=AdminEditUser&id=' + id + 
    '&nickname=' + modalform["login"].value + 
    '&password=' + modalform["password"].value;
    
    cat = 0;
    for(i=0; i<modalform.length; i++)
    {
        if(modalform[i].name == 'group' && modalform[i].checked == true)
        {
            cat = modalform[i].value;
            break;
        }
    }
    str += '&group=' + cat;
    
    if(type == 'del')
        str += '&delete=true';
    SendData(str);
    ModalClose();
}
function AdminCreateUser()
{
    modalform = document.forms['modalform'];
    str =
    'action=AdminCreateUser' + 
    '&nickname=' + modalform["login"].value + 
    '&password=' + modalform["password"].value +
    '&group=' + modalform["group"].value;
    SendData(str);
    ModalClose();
}
function DropEdit(id)
{    
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = 'Редактировать Дропа';
    Foot = document.getElementsByClassName('SaveBtn');
    Foot = Foot[0];
    Foot.innerHTML = 'Сохранить';
        
    Foot.onclick = function() { AdminEditDrop(id); }
        
    modalform = document.forms['modalform'];
    tdname = document.getElementById("tdname" + id)
    tdcountry = document.getElementById("tdcountry" + id)
    tdcity = document.getElementById("tdcity" + id)
    tdcat = document.getElementById("category" + id)
    modalform['name'].value = tdname.innerHTML;
    modalform['country'].value = tdcountry.innerHTML;
    modalform['city'].value = tdcity.innerHTML;
    modalform['cat'].value = tdcat.value;
    GlobalAction = 'DropEdit';
    ModalOpen();
}
function DropCreate()
{
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = 'Создать Дропа';
    Foot = document.getElementsByClassName('SaveBtn');
    Foot = Foot[0];
    Foot.innerHTML = 'Создать';
    Foot.onclick = function() { AdminCreateDrop(); }
    modalform = document.forms['modalform'];
    modalform['country'].value = 'Russia';
    modalform['city'].value = 'Moscow';
    
    GlobalAction = 'DropCreate';
    ModalOpen();
}
function AdminCreateDrop()
{
    modalform = document.forms['modalform'];
    str =
    'action=AdminCreateDrop' + 
    '&name=' + modalform["name"].value + 
    '&country=' + modalform["country"].value +
    '&city=' + modalform["city"].value;
    
    cat = 0;
    for(i=0; i<modalform.length; i++)
    {
        if(modalform[i].name == 'cat' && modalform[i].checked == true)
        {
            cat = modalform[i].value;
            break;
        }
    }
    str += '&cat=' + cat;
    
    SendData(str);
    GlobalAction = 'AdminCreateDrop';
    ModalClose();
}

function AdminEditDrop(id)
{
    modalform = document.forms['modalform'];
    str = 'action=AdminAction&AdAction=DropEdit&id=' + id + 
    '&name=' + modalform["name"].value + 
    '&country=' + modalform["country"].value +
    '&city=' + modalform["city"].value;
    
    cat = 0;
    for(i=0; i<modalform.length; i++)
    {
        if(modalform[i].name == 'cat' && modalform[i].checked == true)
        {
            cat = modalform[i].value;
            break;
        }
    }
    str += '&cat=' + cat;
    
    SendData(str);    
    ModalClose();
}

function DroprDelete(id)
{
    GlobalAction = 'DroprDelete';
    str = 'action=AdminAction' + '&id=' + id + '&AdAction=DroprDelete';
    SendData(str);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
GlobalAction = ''; GlobalID = 0;
function Confirm(str)
{
    answer = confirm(str);
    if(answer)
    {
        return true;
    }
    return false;
}
function Hide(btn)
{    
    ModalClose();
    data = document.forms['order'];
    id = data['OrderId'].value;
    if(btn==false)
    {
        btn = document.getElementById('ordbtnid' + id);
        btn.style.display = "inherit";
    }
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
    //GlobalAction = 'AdminSendTickets';
    id = GlobalID;
    GlobalAction = 'GetNewMessages';
    data = document.forms['SendTicketForm'];
    str = 'action=AdminAction'
    + '&id=' + id
    + '&AdAction=AdminSendTickets'
    + '&message='+ data['message'].value;
    data['message'].value = '';
    SendData(str);
}




function ClientCansel(iddrop)
{
    GlobalAction = 'ClientEdit';
    
    modalform = document.forms['modalform'];
    modalform['OrderId'].value = iddrop;
    OKclick('OrderDelete');
}
function ClientChangeCategory(cat)
{
    GlobalAction = 'ClientChangeCategory';
    str = 'action=ClientAction' + '&ClAction=ClientChangeCategory&cat=' + cat;
    SendData(str);
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function Order(id)
{
    ModalOpen();
    
    btn = document.getElementById('ordbtnid' + id);
    btn.style.display = "none";
    
    tdname = document.getElementById('tdname' + id);
    tdcountry = document.getElementById('tdcountry' + id);
    tdcity = document.getElementById('tdcity' + id);
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = tdname.innerHTML + ', ' + tdcountry.innerHTML + ', ' + tdcity.innerHTML;
    
    modalform = document.forms['modalform'];
    modalform['OrderId'].value = id;
    modalform['group'].value = document.getElementById('group' + id).innerHTML;
    
}
function ClientEdit(iddrop)
{
    ModalOpen();
    
    DOmtcn = document.getElementById("DOmtcn" + iddrop);
    
    DOcountry = document.getElementById("DOcountry" + iddrop);
    
    DOname = document.getElementById("DOname" + iddrop);
    
    DOamount = document.getElementById("DOamount" + iddrop);
    
    DOcurcy = document.getElementById("DOcurcy" + iddrop);
    
    DOcomt = document.getElementById("DOcomt" + iddrop);
    
    dropinfo = document.getElementById("dropinfo" + iddrop);
    
    valueorderform = document.getElementById("valueorderform");
    
    
    Head = document.getElementsByClassName('modal-title');
    Head = Head[0];
    Head.innerHTML = dropinfo.innerHTML;
    
    modalform = document.forms['modalform'];
    
    modalform['OrderId'].value = iddrop;
    modalform['mtcn'].value = DOmtcn.innerHTML;
    modalform['country'].value = DOcountry.innerHTML;
    modalform['name'].value = DOname.innerHTML;
    modalform['amount'].value = DOamount.innerHTML;
    modalform['currency'].value = DOcurcy.innerHTML;
    modalform['comment'].value = DOcomt.innerHTML;
    GlobalAction = 'ClientEdit';
}

function OKclick(action)
{
    var mylist = ['mtcn', 'country', 'name', 'amount', 'comment'];
    
    modalform = document.forms['modalform'];
    id = modalform['OrderId'].value;
    str = 'action=ClientAction' + '&id=' + id + '&ClAction=' + action + '&';
    for(i=0; i<modalform.length; i++)
    {
        str += modalform[i].name + "=" + modalform[i].value;
        if(i < modalform.length-1)
            str += "&";
        if(mylist.indexOf(modalform[i].name)!=-1)
            modalform[i].value = '';
    }
    ModalClose();
    SendData(str);
}


function OpOk(id)
{
    GlobalAction = 'OpActionclickOk';
    itemid = id;
    str = 'action=OperatorAction' + '&id=' + id + '&OpAction=clickOk';
    SendData(str);
}
function OpCans(id)
{
    GlobalAction = 'OpActionclickCans';
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
                    GlobalAction == 'ClientCloseNews' || GlobalAction == 'OpActionclickOk' ||
                    GlobalAction == 'OpActionclickOk' || GlobalAction == 'OpActionclickCans' ||
                    GlobalAction == 'AdminCreateUser' || 
                    GlobalAction == 'AdminCreateDrop'
                    )
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