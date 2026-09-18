<?php

/**
 * models/Siswa.php
 * Semua query database untuk tabel "siswa" ada di sini.
 * Setiap siswa punya kelas_id yang merujuk ke tabel kelas (boleh kosong).
 */

class Siswa
{
    private PDO $db;

    public function __construct()
    {
        global $pdo;
        $this->db = $pdo;
    }

    /** Ambil semua data siswa + nama kelasnya (JOIN ke tabel kelas) */
    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT siswa.*, kelas.nama_jurusan, kelas.kelas AS nama_kelas
             FROM siswa
             LEFT JOIN kelas ON siswa.kelas_id = kelas.id
             ORDER BY siswa.nama_siswa ASC"
        );
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM siswa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, alamat, tanggal_lahir, kelas_id)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nis'],
            $data['nama_siswa'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['tanggal_lahir'],
            $data['kelas_id'] !== '' ? $data['kelas_id'] : null,
        ]);
    }

    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE siswa SET nis = ?, nama_siswa = ?, jenis_kelamin = ?, alamat = ?,
             tanggal_lahir = ?, kelas_id = ? WHERE id = ?"
        );
        return $stmt->execute([
            $data['nis'],
            $data['nama_siswa'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['tanggal_lahir'],
            $data['kelas_id'] !== '' ? $data['kelas_id'] : null,
            $id,
        ]);
    }

    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM siswa WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
