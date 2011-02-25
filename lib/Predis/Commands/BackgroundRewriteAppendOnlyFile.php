<?php

namespace Predis\Commands;

use Predis\Command;

class BackgroundRewriteAppendOnlyFile extends Command {
    public function canBeHashed()  { return false; }
    public function getCommandId() { return 'BGREWRITEAOF'; }
    public function parseResponse($data) {
        return $data == 'Background append only file rewriting started';
    }
}