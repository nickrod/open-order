// form changed

function formChanged(form_el_id)
{
  var form = document.getElementById(form_el_id);
  var changed = false;

  //

  if (form)
  {
    for (i = 0; i < form.elements.length; i++)
    {
      var el = form.elements[i];
      var type = el.type;

      //

      if (type == 'text' || type == 'textarea')
      {
        if (el.value != el.defaultValue)
        {
          changed = true;
        }
      }
      else if (type == 'checkbox' || type == 'radio')
      {
        if (el.checked != el.defaultChecked)
        {
          changed = true;
        }
      }
      else if (type == 'select-one')
      {
        if (el.options[el.selectedIndex].text != el.defaultSelected)
        {
          changed = true;
        }
      }
    }
  }

  //

  return changed;
}

// show more

function showMore(more_el_id, text_el_id)
{
  var more = document.getElementById(more_el_id);
  var text = document.getElementById(text_el_id);

  //

  if (more.style.display === 'none')
  {
    more.style.display = 'block';
    text.innerHTML = 'Show less';
  }
  else
  {
    more.style.display = 'none';
    text.innerHTML = 'Show more';
  }
}

// show hide

function showHide(el_id)
{
  var el = document.getElementById(el_id);

  //

  if (el.style.display === 'none')
  {
    el.style.display = 'inline';
  }
  else
  {
    el.style.display = 'none';
  }
}

// ajax request

function ajax(reqListener, params, method = 'GET', file = 'ajax.php')
{
  var oReq = new XMLHttpRequest();
  oReq.addEventListener('load', reqListener);
  oReq.open(method, file + '?' + params);
  oReq.send();
}

// load function on start

function onStart(func)
{
  document.addEventListener('DOMContentLoaded', func);
}

// load web storage

function loadStore()
{
  if (typeof(Storage) !== 'undefined')
  {
    for (var i = 0; i < localStorage.length; i++)
    {
      var el = document.getElementById(localStorage.key(i));

      //

      if (el)
      {
        el.value = localStorage.getItem(localStorage.key(i));
      }
    }
  }
}

// add web storage

function addStore(value)
{
  if (typeof(Storage) !== 'undefined')
  {
    if (count = Number(localStorage.getItem('count')))
    {
      var index = Number((localStorage.key(localStorage.length - 1)).split('-').pop());

      //

      if (Number.isInteger(index))
      {
        key += ++index; 
      }
      else
      {
        key += '-1';
      }
    }
    else
    {
    }
  }
}

// set web storage

function setStore(key, value)
{
  if (typeof(Storage) !== 'undefined')
  {
    localStorage.setItem(key, value);
  }
}

// get web storage

function getStore(key)
{
  if (typeof(Storage) !== 'undefined')
  {
    return localStorage.getItem(key);
  }
}

// clear web storage

function clearStore()
{
  if (typeof(Storage) !== 'undefined')
  {
    localStorage.clear();
  }
}

// get location

function getLocation(latitude_el_id, longitude_el_id)
{
  latitude_el = document.getElementById(latitude_el_id);
  longitude_el = document.getElementById(longitude_el_id);

  //

  if (navigator.geolocation && latitude_el && longitude_el)
  {
    navigator.geolocation.getCurrentPosition(function(position) { latitude_el.value = position.coords.latitude; longitude_el.value = position.coords.longitude; }, function(error) { var code = error.code; }, { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 });
  }
}

//

function itemIndex(id, el_id, type)
{
  var el = document.getElementById(el_id);

  //

  if (Number.isInteger(type) && id.length > 1 && el && typeof item_id[type] !== 'undefined')
  {
    // clear value

    el.value = '';

    //

    var index = item_id[type].indexOf(id);

    //

    if (index >= 0)
    {
      el.value = item_title[type][index].split(String.fromCharCode(30))[0];
    }

    // store value

    setStore(el.id, el.value);
  }
  else if (el)
  {
    el.value = '';
    setStore(el.id, el.value);
  }
}

//

function itemFill(id, title, el_id, title_el_id, result_el_id)
{
  var el = document.getElementById(el_id);
  var title_el = document.getElementById(title_el_id);
  var result_el = document.getElementById(result_el_id);

  //

  if (id && el)
  {
    el.value = id;
    setStore(el.id, el.value);
  }

  //

  if (title && title_el)
  {
    title_el.value = title;
    setStore(title_el.id, title_el.value);
  }

  //

  if (result_el)
  {
    result_el.style.display = 'none';
  }
}

//

function itemSearch(root_el_id, el_id, fill_el_id, title_el_id, type)
{
  var str = document.getElementById(root_el_id).value;
  var el = document.getElementById(el_id);

  //

  if (Number.isInteger(type) && str.length > 1 && fill_el_id && title_el_id && el && typeof item_title[type] !== 'undefined' && typeof item_id[type] !== 'undefined' && typeof item_size[type] !== 'undefined')
  {
    // convert to lower case

    str =  str.toLowerCase();

    // show div

    el.style.display = 'block';

    //

    var result = item_title[type].findIndex(element => element.includes(str));
    var list = '';

    //

    if (result >= 0)
    {
      for (var count = result; count < result + 5 && count < item_size[type]; count++)
      {
        list += '<button type="button" class="list-group-item list-group-item-action" onclick="itemFill(\'' + item_id[type][count] + '\', \'' + item_title[type][count].split(String.fromCharCode(30))[0] + '\', \'' + fill_el_id + '\', \'' + title_el_id + '\', \'' + el_id + '\'); document.getElementById(\'' + root_el_id + '\').value=\'\';">' + item_title[type][count].split(String.fromCharCode(30))[0] + '</button>';
      }
    }
    else
    {
      list += '<button type="button" class="list-group-item list-group-item-action" onclick="document.getElementById(\'' + root_el_id + '\').value=\'\'; document.getElementById(\'' + el_id + '\').style.display = \'none\';">No results</button>';
    }

    //

    el.innerHTML = list;
  }
  else if (el)
  {
    el.style.display = 'none';
  }
}
