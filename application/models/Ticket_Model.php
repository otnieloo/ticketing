<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket_Model extends CI_Model
{

    public function get_all_ticket($limit)
    {
        $data_ticket = (object)[];
        $sql = "SELECT * FROM list_ticket lt ORDER BY date_created DESC LIMIT $limit";

        $query = $this->db->query($sql);
        if ($query) {
            $data_ticket = $query->result();
        }

        foreach ($data_ticket as $index => $ticket) {
            $sql = "SELECT * FROM list_ticket_message WHERE ticket_number = ?";
            $query = $this->db->query($sql, array($ticket->ticket_number));
            if ($query) {
                $data_ticket[$index]->messages = $query->result();
            }
        }


        return $data_ticket;
    }

    public function get_ticket($ticket_number)
    {
        $data_ticket = (object)[];
        $sql = "SELECT * FROM list_ticket lt WHERE ticket_number = ?";

        $query = $this->db->query($sql, array($ticket_number));

        if ($query) {
            $data_ticket = $query->result();
        }

        foreach ($data_ticket as $index => $ticket) {
            $sql = "SELECT * FROM list_ticket_message WHERE ticket_number = ?";
            $query = $this->db->query($sql, array($ticket_number));
            if ($query) {
                $data_ticket[$index]->messages = $query->result();
            }
        }

        return $data_ticket;
    }

    public function create_ticket($data = NULL)
    {
        $data = (object) $data;
        if ($data != NULL) {

            $sql = "INSERT INTO list_ticket (ticket_id, ticket_number, subject, priority) VALUES (UUID(), ?, ?, ?) ";
            $query = $this->db->query($sql, array($data->ticket_number, $data->subject, $data->priority));
            if ($query) {
                // Insert messages
                $sql = "INSERT INTO list_ticket_message (ticket_number, message) VALUES (?, ?) ";
                $query = $this->db->query($sql, array($data->ticket_number, $data->message));

                if ($query) {
                    return $data->ticket_number;
                }
            }
        }
        return false;
    }

    public function create_reply_ticket($data = NULL)
    {
        $data = (object) $data;
        if ($data != NULL) {

            $sql = "SELECT ticket_number FROM list_ticket WHERE ticket_number = ? ";
            $query = $this->db->query($sql, array($data->ticket_number));

            if ($query && $query->num_rows() > 0) {
                $sql = "UPDATE list_ticket SET status = 1 WHERE ticket_number = ? ";
                $query = $this->db->query($sql, array($data->ticket_number));
                if ($query) {
                    // Insert messages
                    $sql = "INSERT INTO list_ticket_message (ticket_number, message) VALUES (?, ?) ";
                    $query = $this->db->query($sql, array($data->ticket_number, $data->message));

                    if ($query) {
                        return (object)[
                            'status' => true,
                            'message' => "Ticket number $data->ticket_number is replied successfully."
                        ];
                    }
                }
            } else {
                return (object)[
                    'status' => false,
                    'message' => "Sorry. Ticket is not found."
                ];
            }
        }
        return (object)[
            'status' => false,
            'message' => "Sorry. Ticket is failed to reply."
        ];
    }

    public function close_ticket($data = NULL)
    {
        $data = (object) $data;
        if ($data != NULL) {
            $sql = "SELECT ticket_number FROM list_ticket WHERE ticket_number = ?";
            $query = $this->db->query($sql, array($data->ticket_number));

            if ($query && $query->num_rows() > 0) {
                $sql = "UPDATE list_ticket SET status = 2 WHERE ticket_number = ? ";
                $query = $this->db->query($sql, array($data->ticket_number));

                if ($query) {
                    return (object)[
                        'status' => true,
                        'message' => "Ticket number $data->ticket_number is close successfully."
                    ];
                }
            } else {
                return (object)[
                    'status' => false,
                    'message' => "Sorry. Ticket is not found."
                ];
            }
        }
        return (object)[
            'status' => false,
            'message' => "Sorry. Ticket is failed to close."
        ];
    }

    public function delete_ticket($data = NULL)
    {
        $data = (object) $data;
        if ($data != NULL) {
            // Get ticket number
            $sql = "SELECT ticket_number FROM list_ticket WHERE ticket_id = ?";
            $query = $this->db->query($sql, array($data->id));

            if ($query && $query->num_rows() > 0) {
                $ticket_number = $query->row()->ticket_number;

                $sql = "DELETE FROM list_ticket WHERE ticket_number = ? ";
                $query = $this->db->query($sql, array($ticket_number));

                $sql = "DELETE FROM list_ticket_message WHERE ticket_number = ? ";
                $query = $this->db->query($sql, array($ticket_number));
                if ($query) {
                    return (object)[
                        "status" => true,
                        "message" => "Ticket with id $data->id is deleted successfully."
                    ];
                }
            } else {
                return (object)[
                    "status" => false,
                    "message" => "Ticket is not found."
                ];
            }
        }
        return (object)[
            "status" => false,
            "message" => "Ticket is failed to delete."
        ];
    }

    public function get_last_ticket_number()
    {
        $sql = "SELECT ticket_number FROM list_ticket ORDER BY date_created DESC LIMIT 1";
        $query = $this->db->query($sql);

        if ($query && $query->num_rows() > 0) {
            return $query->row()->ticket_number;
        }
        return 1;
    }
}
