<?php

/**
 * models/Mapel.php
 * Semua query database untuk tabel "mapel" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class Mapel
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data mapel */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM mapel ORDER BY nama_mapel ASC");
        return $stmt->fetchAll();
    }

    /** Ambil satu data mapel berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM mapel WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data mapel baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO mapel (kode_mapel, nama_mapel)
             VALUES (?, ?)"
        );
        return $stmt->execute([
            $data['kode_mapel'],
            $data['nama_mapel'],
        ]);
    }

    /** Update data mapel */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE mapel SET nama_mapel = ?, kode_mapel = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['nama_mapel'],
            $data['kode_mapel'],
            $id,
        ]);
    }

    /** Hapus data mapel */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM mapel WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
