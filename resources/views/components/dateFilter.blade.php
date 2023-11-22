<form method="GET" action="{{ $actionUrl }}">
    <div class="flex m-4 items-center">
        <div>
            <select name="date_parameter" id="date_parameter"
                class="bg-gray-200 rounded p-2.5 text-sm text-gray-700 focus:bg-white">
                <option value="">
                    Filter by Date
                </option>
                <option value="date" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Date</option>    
                <option value="month" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Month</option>
                <option value="year" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Year</option>
            </select>  
        </div>
        <div class="relative w-full">
            <div id="fieldContainer">

            </div>
            <div id="searchButton" class="hidden">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-gray-700 rounded-r-lg border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
        
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let dateParameterSelect = document.getElementById('date_parameter');
        let fieldContainer = document.getElementById('fieldContainer');
        let searchButton = document.getElementById('searchButton');
        
        dateParameterSelect.addEventListener('change', function() {

            searchButton.style.display = 'block';

            let selectedValue = this.value;
            
            fieldContainer.innerHTML = '';

            if (selectedValue === '') {
                searchButton.style.display = 'none';
            }

            if (selectedValue === 'date') {
                let dateInput = document.createElement('input');
                dateInput.type = 'date';
                dateInput.name = 'query';
                dateInput.id = 'query';
                dateInput.className = 'block p-2.5 pr-16 w-full text-sm text-gray-900 bg-gray-50 rounded-r-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500';
                
                let dateOption = document.createElement('div');
                dateOption.id = 'date_option';
                dateOption.appendChild(dateInput);
                
                fieldContainer.appendChild(dateOption);
            } else if (selectedValue === 'month') {
                let monthSelect = document.createElement('select');
                monthSelect.name = 'query';
                monthSelect.id = 'query';
                monthSelect.className = 'block p-2.5 mr-12 w-full text-sm text-gray-900 bg-gray-50 rounded-r-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500';
                
                let selectOption = document.createElement('option');
                selectOption.value = '';
                selectOption.textContent = 'Select Month';
                monthSelect.appendChild(selectOption);
                
                let monthOption = document.createElement('div');
                monthOption.id = 'month_option';
                monthOption.appendChild(monthSelect);
                fieldContainer.appendChild(monthOption);
                
                const months = [
                    { value: '01', name: 'January' },
                    { value: '02', name: 'February' },
                    { value: '03', name: 'March' },
                    { value: '04', name: 'April' },
                    { value: '05', name: 'May' },
                    { value: '06', name: 'June' },
                    { value: '07', name: 'July' },
                    { value: '08', name: 'August' },
                    { value: '09', name: 'September' },
                    { value: '10', name: 'October' },
                    { value: '11', name: 'November' },
                    { value: '12', name: 'December' }
                ];

                months.forEach(function(month) {
                    let option = document.createElement('option');
                    option.value = month.value;
                    option.textContent = month.name;
                    monthSelect.appendChild(option);
                });
            } else if (selectedValue === 'year') {
                let yearInput = document.createElement('input');
                yearInput.type = 'number';
                yearInput.min = '1900';
                yearInput.name = 'query';
                yearInput.id = 'query';
                yearInput.className = 'block p-2.5 pr-16 w-full text-sm text-gray-900 bg-gray-50 rounded-r-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500';
                
                let yearOption = document.createElement('div');
                yearOption.id = 'year_option';
                yearOption.appendChild(yearInput);
                
                fieldContainer.appendChild(yearOption);
            }
        });
    });
</script>