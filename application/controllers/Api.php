<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Ticket_Model', 'ticketmodel');
    }

    public function index_get($ticket_number = 0, $limit = 100)
    {
        if ($ticket_number == 0) {
            $tickets = $this->ticketmodel->get_all_ticket($limit);
            if ($tickets) {
                $this->response($tickets, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No tickets were found'
                ], 404);
            }
        } else {
            $ticket = $this->ticketmodel->get_ticket($ticket_number);
            if ($ticket) {
                $this->response($ticket, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such ticket found'
                ], 404);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'subject' => $this->post('subject'),
            'message' => $this->post('message'),
            // 'status' => $this->post('status'),
            'priority' => $this->post('priority'),
            'ticket_number' => $this->ticketmodel->get_last_ticket_number() + 1,
        ];

        $insert_ticket = $this->ticketmodel->create_ticket($data);
        if ($insert_ticket !== FALSE) {
            $this->response([
                'status' => true,
                'message' => "Ticket created successfully. Ticket number is $insert_ticket."
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Sorry, the ticket failed to create.'
            ], 200);
        }
    }

    public function index_put()
    {
        $data = [
            'ticket_number' => $this->put('ticket_number'),
        ];

        $close_ticket = $this->ticketmodel->close_ticket($data);
        if ($close_ticket !== FALSE) {
            $this->response([
                'status' => true,
                'message' => "Ticket number " . $data['ticket_number'] . " is close successfully."
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Sorry, the ticket is failed to close.'
            ], 200);
        }
    }

    public function index_delete()
    {
        $data = [
            'id' => $this->delete('id'),
        ];

        $close_ticket = $this->ticketmodel->delete_ticket($data);
        if ($close_ticket->status !== FALSE) {
            $this->response($close_ticket, 200);
        } else {
            $this->response($close_ticket, 200);
        }
    }

    public function reply_post()
    {
        $data = [
            'message' => $this->post('message'),
            'ticket_number' => $this->post('ticket_number'),
        ];

        $insert_ticket = $this->ticketmodel->create_reply_ticket($data);
        if ($insert_ticket->status !== FALSE) {
            $this->response($insert_ticket, 201);
        } else {
            $this->response($insert_ticket, 200);
        }
    }
}
