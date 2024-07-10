var items = [
  [
    '001',
    'Keyboard Logitek',
    60000,
    'Keyboard yang mantap untuk kantoran',
    'logitek.jpg',
  ],
  ['002', 'Keyboard MSI', 300000, 'Keyboard gaming MSI mekanik', 'msi.jpg'],
  [
    '003',
    'Mouse Genius',
    50000,
    'Mouse Genius biar lebih pinter',
    'genius.jpeg',
  ],
  ['004', 'Mouse Jerry', 30000, 'Mouse yang disukai kucing', 'jerry.jpg'],
]
var dataInput = 'Keyboard'

let newArr = items.filter((product) =>
  product[1].toLowerCase().includes(dataInput.toLowerCase())
)

console.log(newArr);