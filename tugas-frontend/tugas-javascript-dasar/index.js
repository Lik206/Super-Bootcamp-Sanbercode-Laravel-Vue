// Soal String

// Jawaban Soal 1
var word = 'JavaScript'
var second = 'is'
var third = 'awesome'
var fourth = 'and'
var fifth = 'I'
var sixth = 'love'
var seventh = 'it!'

var sentence1 = `${word} ${second} ${third} ${fourth} ${fifth} ${sixth} ${seventh}`
console.log('----------Soal string: Jawaban 1------------')
console.log(sentence1)

// Jawaban Soal 2
var sentence = 'I am going to be Web Developer'
var arr = sentence.split(' ')

var [first, second, third, fourth, fifth, sixth, eighth] = arr

console.log('----------Soal string: Jawaban 2------------')
console.log(`First Word : ${first}`)
console.log(`Second Word : ${second}`)
console.log(`Third Word : ${third}`)
console.log(`Fourth Word : ${fourth}`)
console.log(`Fifth Word : ${fifth}`)
console.log(`Sixth Word : ${sixth}`)
console.log(`Eighth Word : ${eighth}`)

// Jawaban Soal 3
var sentence3 = 'wow JavaScript is so cool'

var exampleFirstWord3 = sentence3.substring(0, 3)
var secondWord3 = sentence3.substring(4, 14) // do your own!
var thirdWord3 = sentence3.substring(15, 17) // do your own!
var fourthWord3 = sentence3.substring(18, 20) // do your own!
var fifthWord3 = sentence3.substring(21, 25) // do your own!

var firstWordLength = exampleFirstWord3.length
var secondWordLength = secondWord3.length
var thirdWordLength = thirdWord3.length
var fourthWordLength = fourthWord3.length
var fifthWordLength = fifthWord3.length

console.log('----------Soal string: Jawaban 3------------')
console.log(`First Word: ${exampleFirstWord3}, with length: ${firstWordLength}`)
console.log(`Second Word: ${secondWord3}, with length: ${secondWordLength}`)
console.log(`Third Word: ${thirdWord3}, with length: ${thirdWordLength}`)
console.log(`Fourth Word: ${fourthWord3}, with length: ${fourthWordLength}`)
console.log(`Fifth Word: ${fifthWord3}, with length: ${fifthWordLength}`)

// Soal Function

// Jawaban Soal 1
function teriak() {
  return 'Halo Sanbers!'
}
console.log('----------Soal Function: Jawaban 1------------')
console.log(teriak()) // "Halo Sanbers!"

// Jawaban Soal 2
function kalikan(num1, num2) {
  return num1 * num2
}
console.log('----------Soal Function: Jawaban 2------------')
console.log(kalikan(4, 12)) // 48

// Jawaban Soal 3
function introduce(name, age, address, hobby) {
  return `Nama saya ${name}, umur saya ${age} tahun, alamat saya di ${address}, dan saya punya hobby yaitu ${hobby}!`
}
console.log('----------Soal Function: Jawaban 3------------')
console.log(introduce('Agus', 30, 'Jogja', 'Gaming'))

// Soal Conditional

// Jawaban Soal if-else
var nama = 'Budi'
var peran = 'Guard'

console.log('----------Soal Condition: Jawaban if-else------------')
if (nama === '' && peran === '') {
  console.log('Nama harus diisi!')
} else if (nama && peran === '') {
  console.log(`Halo ${nama}, Pilih peranmu untuk memulai game!`)
} else if (nama && peran.toLowerCase() === 'penyihir') {
  console.log(`Selamat datang di Dunia Werewolf, ${nama}`)
  console.log(
    `Halo Penyihir ${nama}, kamu dapat melihat siapa yang menjadi werewolf!`
  )
} else if (nama && peran.toLowerCase() === 'guard') {
  console.log(`Selamat datang di Dunia Werewolf, ${nama}`)
  console.log(
    `Halo Guard ${nama}, kamu akan membantu melindungi temanmu dari serangan werewolf.`
  )
} else if (nama && peran.toLowerCase() === 'werewolf') {
  console.log(`Selamat datang di Dunia Werewolf, ${nama}`)
  console.log(`Halo Werewolf ${nama}, Kamu akan memakan mangsa setiap malam!`)
} else {
  console.log('Nama harus diisi / Peran tidak tersedia!')
}

// Soal While Loop

// Jawaban Looping While
console.log('----------Soal While Loop: Jawaban While Loop------------')

var asc = 1

console.log('LOOPING PERTAMA')
while (asc <= 20) {
  if (asc % 2 == 0) {
    console.log(`${asc} - I love coding`)
  }
  asc++
}

var desc = 20

console.log('LOOPING KEDUA')
while (desc > 0) {
  if (desc % 2 == 0) {
    console.log(`${desc} - I love coding`)
  }
  desc--
}
