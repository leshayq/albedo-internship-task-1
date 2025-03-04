const fetchCountries = async () => {
    const response = await fetch('https://restcountries.com/v3.1/all');
    const data = await response.json();
    return data;
  };

const countrySelect = document.getElementById('countrySelect');

fetchCountries().then(countries => {
countries.sort((a, b) => a.name.common.localeCompare(b.name.common));
    countries.forEach(country => {
        const option = document.createElement('option');
        option.value = country.name.common;
        option.textContent = country.name.common;

        countrySelect.appendChild(option);
    });
});