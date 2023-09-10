const ServerSideSortOptions = ['price'];

function fetchCarData(sortBy) {
    let url;
    
    if (ServerSideSortOptions.includes(sortBy)) {
        url = '/cars/sort/' + sortBy;
    } else {
        url = '/cars';
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach(car => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${car.car_name}</td>
                    <td>${car.price}</td>
                    <td>${car.discount}</td>
                    <td>${car.hand}</td>
                    <td>${car.availability}</td>
                    <td>${car.color}</td>
                `;
                tbody.appendChild(row);
            });
        });
}

function sortData(sortBy) {
    if (ServerSideSortOptions.includes(sortBy)) {
        fetchCarData(sortBy);
    } else {
        const table = document.getElementById('carTable');
        const tbody = table.querySelector('tbody');

        const rows = Array.from(tbody.getElementsByTagName('tr'));

        const dataRows = rows.map(row => {
            const columns = Array.from(row.getElementsByTagName('td'));
            const data = {};
            columns.forEach((column, index) => {
                const columnName = table.querySelector('thead tr th:nth-child(' + (index + 1) + ')').getAttribute('data-column');
                data[columnName] = column.textContent.trim();
            });
            return { row, data };
        });

        dataRows.sort((a, b) => {
            const aValue = a.data[sortBy];
            const bValue = b.data[sortBy];
            return aValue.localeCompare(bValue, undefined, { numeric: true, sensitivity: 'base' });
        });

        tbody.innerHTML = '';

        dataRows.forEach(dataRow => {
            tbody.appendChild(dataRow.row);
        });
    }
}

// Initial load of data
fetchCarData('');
