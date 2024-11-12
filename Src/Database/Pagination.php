<?php 

namespace Src\Database;

class Pagination {

    private int $currentPage = 1;
    private int $totalPages;
    private int $linksPerPage = 5;
    private int $itemsPerPage = 10;
    private int $totalItems;
    private string $pageIdentifier = 'page';

    // Define o total de itens a serem paginados
    public function setTotalItems(int $totalItems): void
    {
        $this->totalItems = $totalItems;
    }

    // Define o identificador da página na URL
    public function setPageIdentifier(string $identifier): void
    {
        $this->pageIdentifier = $identifier;
    }

    // Define a quantidade de itens por página
    public function setItemsPerPage(int $itemsPerPage): void
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    // Retorna o total de itens
    public function getTotal(): int 
    {
        return $this->totalItems;
    }

    // Retorna a quantidade de itens por página
    public function getPerPage(): int 
    {
        return $this->itemsPerPage;
    }

    // Calcula o limite e o offset para a consulta de paginação
    private function calculations(): string
    {
        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itemsPerPage;

        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);

        return "limit {$this->itemsPerPage} offset {$offset}";
    }

    // Retorna a string de paginação com limite e offset calculados
    public function dump(): string
    {
        return $this->calculations();
    }

    // Gera os links de navegação da paginação em HTML
    public function links(): string
    {
        $links = "<ul class='pagination'>";

        if ($this->currentPage > 1) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));
            $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Anterior</a></li>";
            $links .= "<li class='page-item'><a href='?{$first}' class='page-link'>Primeira</a></li>";
        }

        // Gera links numéricos para a navegação da paginação
        for ($i = $this->currentPage - $this->linksPerPage; $i <= $this->currentPage + $this->linksPerPage; $i++) {
            if ($i > 0 && $i <= $this->totalPages) {
                $class = $this->currentPage === $i ? 'active' : '';
                $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $i]));
                $links .= "<li class='page-item {$class}'><a href='?{$linkPage}' class='page-link'>{$i}</a></li>";
            }
        }

        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));
            $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Próxima</a></li>";
            $links .= "<li class='page-item'><a href='?{$last}' class='page-link'>Última</a></li>";
        }

        $links .= "</ul>";

        return $links;
    }

}
