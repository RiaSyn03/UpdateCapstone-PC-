let calendar = document.querySelector('.calendar')

const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

isLeapYear = (year) => {
    return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 ===0)
}

getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28
}

generateCalendar = (month, year) => {

    let calendar_days = calendar.querySelector('.calendar-days')
    let calendar_header_year = calendar.querySelector('#year')

    let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

    calendar_days.innerHTML = ''

    let currDate = new Date()
    if (month == null) month = currDate.getMonth()
    if (!year) year = currDate.getFullYear()

    let curr_month = `${month_names[month]}`
    month_picker.innerHTML = curr_month
    calendar_header_year.innerHTML = year
    // get first day of month
    
    let first_day = new Date(year, month, 1)

    for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
        let day = document.createElement('div')
        if (i >= first_day.getDay()) {
            day.classList.add('calendar-day-hover'+ (i - first_day.getDay() + 1))
            day.innerHTML = i - first_day.getDay() + 1
            day.id = "" + (i - first_day.getDay() + 1)
            day.onclick = function() { toggle(day.id); };
            if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                day.classList.add('curr-date')
            }
        }
        calendar_days.appendChild(day)
    }

    // if(currDate < 10){
    //   currDate = '0' + currDate;
    // }
    // if( curr_month < 10){
    //   curr_month = '0' + curr_month;
    // }
    // var minDate = currDate;
    
    // document.getElementById("hide").setAttribute('min', minDate)
}



let month_list = calendar.querySelector('.month-list')

month_names.forEach((e, index) => {
    let month = document.createElement('div')
    month.innerHTML = `<div data-month="${index}">${e}</div>`
    month.querySelector('div').onclick = () => {
        month_list.classList.remove('show')
        curr_month.value = index
        generateCalendar(index, curr_year.value)
    }
    month_list.appendChild(month)
})

let month_picker = calendar.querySelector('#month-picker')

month_picker.onclick = () => {
    month_list.classList.add('show')

}

let currDate = new Date()

let curr_month = {value: currDate.getMonth()}
let curr_year = {value: currDate.getFullYear()}


generateCalendar(curr_month.value, curr_year.value)

document.querySelector('#prev-year').onclick = () => {
    --curr_year.value
    generateCalendar(curr_month.value, curr_year.value)
}

document.querySelector('#next-year').onclick = () => {
    ++curr_year.value
    generateCalendar(curr_month.value, curr_year.value)
}

function toggle(idd){
    if(idd != null){
        var s = idd
        var tr = curr_month.value + 1
        var appointmentdate = document.getElementById("appointmentDate").innerHTML =  tr + "/" + s + "/" + curr_year.value ;
        document.getElementById('appointdate').value = appointmentdate;
    }
    
    var blur = document.getElementById('blur');
     blur.classList.toggle('active');
    var popup = document.getElementById('popup');
    popup.classList.toggle('active');
    
}



  
const selector = document.querySelector('.custom-select');
  
selector.addEventListener('change', e => {
  console.log('changed', e.target.value)
})

selector.addEventListener('mousedown', e => {
  if(window.innerWidth >= 420) {// override look for non mobile
    e.preventDefault();
    
    const select = selector.children[0];
    const dropDown = document.createElement('ul');
    dropDown.className = "selector-options";
    
    [...select.children].forEach(option => {
      const dropDownOption = document.createElement('li');
      dropDownOption.textContent = option.textContent;
      
      dropDownOption.addEventListener('mousedown', (e) => {
        e.stopPropagation();
        select.value = option.value;
        selector.value = option.value;
        select.dispatchEvent(new Event('change'));
        selector.dispatchEvent(new Event('change'));
        dropDown.remove();
      });

      dropDown.appendChild(dropDownOption);   
    });

    selector.appendChild(dropDown);
    
    // handle click out
    document.addEventListener('click', (e) => {
      if(!selector.contains(e.target)) {
        dropDown.remove();
      }
    });
  }
});
