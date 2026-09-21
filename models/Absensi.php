<?php

/**
 * models/Absensi.php
 * Semua query database untuk tabel "absensi" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class Absensi
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data absensi */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM absensi ORDER BY tanggal DESC");
        return $stmt->fetchAll();
    }

    /** Ambil satu data absensi berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM absensi WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data absensi baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO absensi (siswa_id, tanggal, status, keterangan)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['siswa_id'],
            $data['tanggal'],
            $data['status'],
            $data['keterangan'],
        ]);
    }

    /** Update data absensi */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE absensi SET siswa_id = ?, tanggal = ?, status = ?, keterangan = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['siswa_id'],
            $data['tanggal'],
            $data['status'],
            $data['keterangan'],
            $id,
        ]);
    }

    /** Hapus data absensi */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM absensi WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
