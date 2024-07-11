import fs from 'fs'
import fsPromise from 'fs/promises'


const path = 'data.json'

export const register = (inputData) => {
  let [name, password, role] = inputData.split(',')

  fs.readFile(path, (err, data) => {
    if (err) console.log(err)

    let dataJson = JSON.parse(data)

    if (role === 'trainer') {
      dataJson.push({ name, password, role, isLogin: false, students: [] })
    } else {
      dataJson.push({ name, password, role, isLogin: false })
    }

    fs.writeFile(path, JSON.stringify(dataJson), (err) => {
      if (err) console.log(err)
      else console.log('Berhasil register')
    })
  })
}

export const login = (inputData) => {
  let [name, password] = inputData.split(',')

  fsPromise
    .readFile(path)
    .then((data) => {
      let db = JSON.parse(data)

      let indexUser = db.findIndex((user) => user.name == name)
      // console.log(indexUser);

      if (indexUser < 0) {
        console.log('User tidak ditemukan')
      } else {
        let updateUser = db[indexUser]

        if (updateUser.password === password) {
          updateUser.isLogin = true

          db.splice(indexUser, 1, updateUser)
          console.log('Berhasil login')

          fsPromise.writeFile(path, JSON.stringify(db))
        } else {
          console.log('password yang dimasukkan salah')
        }
      }
    })
    .catch((err) => {
      console.log(err)
    })
}

export const addSiswa = async (inputData) => {
  try {
    let [name, nameTrainer] = inputData.split(',')
    const db = await fsPromise.readFile(path)
    const data = JSON.parse(db)
    const admin = data.filter((user) => user.role.toLowerCase() == 'admin')
    const getAdmin = admin[0]


    const indexTrainer = data.findIndex((trainer) => trainer.name == nameTrainer)
    const trainer = data[indexTrainer]
    

    if (getAdmin.isLogin != false) {
        let newStudent = {name: name}
        trainer.students.push(newStudent)
        data.splice(indexTrainer, 1, trainer)
        const addStudent = fsPromise.writeFile(path, JSON.stringify(data))
        await addStudent
        console.log('Berhasil add siswa')
    } else {
      console.log('Admin harus Login terlebih dahulu')
    }
  } catch (error) {
    console.log(error)
  }
}
