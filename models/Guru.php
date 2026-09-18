<?php
/**
 * models/Guru.php
 * Semua query database untuk tabel "guru" ada di sini.
 * Controller TIDAK boleh menulis query SQL langsung — selalu lewat Model.
 */

class Guru
{
    private PDO $db;

    public function __construct()
    {
        global $pdo; // koneksi PDO dari config/database.php
        $this->db = $pdo;
    }

    /** Ambil semua data guru */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM guru ORDER BY nama_guru ASC");
        return $stmt->fetchAll();
    }

    /** Ambil satu data guru berdasarkan id */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM guru WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /** Tambah data guru baru */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO guru (nip, nama_guru, jenis_kelamin, alamat, no_hp)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nip'],
            $data['nama_guru'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['no_hp'],
        ]);
    }

    /** Update data guru */
    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE guru SET nip = ?, nama_guru = ?, jenis_kelamin = ?, alamat = ?, no_hp = ?
             WHERE id = ?"
        );
        return $stmt->execute([
            $data['nip'],
            $data['nama_guru'],
            $data['jenis_kelamin'],
            $data['alamat'],
            $data['no_hp'],
            $id,
        ]);
    }

    /** Hapus data guru */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM guru WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
