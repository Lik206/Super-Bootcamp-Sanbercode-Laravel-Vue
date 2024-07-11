import { addSiswa, login, register } from "./libs/Controllers";

const args = process.argv
const command = args[2]
const input = args[3]

switch (command) {
    case 'register':
        register(input)
        break;
    case 'login':
        login(input)
        break;
    case 'addSiswa':
        addSiswa(input)
        break;
    default:
        console.log('perintah tidak ditemukan');
        break;
}