<?php

/**
 * models/Kelas.php
 * Semua query database untuk tabel "kelas" ada di sini.
 * Setiap kelas punya wali_kelas_id yang merujuk ke tabel guru (boleh kosong).
 */

class Kelas
{
    private PDO $db;

    public function __construct()
    {
        global $pdo;
        $this->db = $pdo;
    }

    /** Ambil semua data kelas + nama wali kelasnya (JOIN ke tabel guru) */
    public function getAll(): array
    {
        $stmt = $this->db->query("
                SELECT kelas.*,
                guru.nama_guru AS wali_kelas
                FROM kelas
                LEFT JOIN guru ON kelas.wali_kelas_id = guru.id
                ORDER BY kelas.nama_jurusan ASC, kelas.kelas ASC
             ");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kelas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO kelas (nama_jurusan, kelas, wali_kelas_id) VALUES (?, ?, ?)"
        );
        return $stmt->execute([
            $data['nama_jurusan'],
            $data['kelas'],
            $data['wali_kelas_id'] !== '' ? $data['wali_kelas_id'] : null,
        ]);
    }

    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE kelas SET nama_jurusan = ?, kelas = ?, wali_kelas_id = ? WHERE id = ?"
        );
        return $stmt->execute([
            $data['nama_jurusan'],
            $data['kelas'],
            $data['wali_kelas_id'] !== '' ? $data['wali_kelas_id'] : null,
            $id,
        ]);
    }

    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM kelas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
