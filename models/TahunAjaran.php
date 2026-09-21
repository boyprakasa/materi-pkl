<?php

/**
 * models/TahunAjaran.php
 * Semua query database untuk tabel "tahun_ajaran" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class TahunAjaran
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data tahun_ajaran */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM tahun_ajaran ORDER BY nama_tahun_ajaran ASC");
        return $stmt->fetchAll();
    }

    /** Ambil satu data tahun_ajaran berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tahun_ajaran WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data tahun_ajaran baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO tahun_ajaran (nama_tahun_ajaran, semester, status)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([
            $data['nama_tahun_ajaran'],
            $data['semester'],
            $data['status'],
        ]);
    }

    /** Update data tahun_ajaran */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE tahun_ajaran SET nama_tahun_ajaran = ?, semester = ?, status = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['nama_tahun_ajaran'],
            $data['semester'],
            $data['status'],
            $id,
        ]);
    }

    /** Hapus data tahun_ajaran */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tahun_ajaran WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
