<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('sga_tb_adm_cliente', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->integer('id_fase')->nullable();
            $table->char('id_mod_ing', 1)->nullable();
            $table->string('c_apepat', 50)->nullable();
            $table->string('c_apemat', 50)->nullable();
            $table->string('c_nombres', 50)->nullable();
            $table->string('c_tipdoc', 10)->nullable();
            $table->string('c_numdoc', 11)->nullable();
            $table->date('d_fecnac')->nullable();
            $table->char('c_dptonac', 2)->nullable();
            $table->char('c_provnac', 2)->nullable();
            $table->char('c_distnac', 2)->nullable();
            $table->char('c_dptodom', 2)->nullable();
            $table->char('c_provdom', 2)->nullable();
            $table->char('c_distdom', 2)->nullable();
            $table->string('c_dir', 100)->nullable();
            $table->string('c_codpos', 20)->nullable();
            $table->string('c_fono', 30)->nullable();
            $table->string('c_celu', 30)->nullable();
            $table->string('c_email', 50)->nullable();
            $table->string('c_procedencia', 100)->nullable();
            $table->string('c_colg_ubicacion', 300)->nullable();
            $table->string('c_tippro', 4)->nullable();
            $table->string('c_anoegreso', 4)->nullable();
            $table->char('c_codfac1', 1)->nullable();
            $table->string('c_codesp1', 5)->nullable();
            $table->char('c_codfac2', 1)->nullable();
            $table->string('c_codesp2', 5)->nullable();
            $table->string('c_sedcod', 4)->nullable();
            $table->string('c_codmod', 2)->nullable();
            $table->string('id_tab_turno', 10)->nullable();
            $table->string('id_tab_sitalu', 10)->nullable();
            $table->string('c_nomapo', 100)->nullable();
            $table->string('c_dniapo', 11)->nullable();
            $table->string('c_fonoapo', 30)->nullable();
            $table->string('c_celuapo', 30)->nullable();
            $table->string('c_parentescoapo', 40)->nullable();
            $table->string('c_nomapo_2', 100)->nullable();
            $table->string('c_dniapo_2', 11)->nullable();
            $table->string('c_fonoapo_2', 30)->nullable();
            $table->string('c_celuapo_2', 30)->nullable();
            $table->string('c_parentescoapo_2', 40)->nullable();
            $table->integer('id_proceso')->nullable();
            $table->string('id_tab_alu_contact', 10)->nullable();
            $table->string('c_obs', 300)->nullable();
            $table->char('c_sexo', 1)->nullable();
            $table->string('c_paisnac', 2)->nullable();
            $table->string('id_user', 50)->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->string('cod_asesor', 50)->nullable();
            $table->date('f_updated_asesor')->nullable();
            $table->string('user_upd_asesor', 50)->nullable();
            $table->string('c_procedencia_ext', 150)->nullable();
            $table->tinyInteger('b_pago')->default(0);
            $table->date('f_val_pago')->nullable();
            $table->string('user_val_pago', 20)->nullable();
            $table->tinyInteger('b_rec_pago')->default(0);
            $table->string('c_rec_motivo', 200)->nullable();
            $table->date('f_rec_pago')->nullable();
            $table->string('user_rec_pago', 20)->nullable();
            $table->tinyInteger('b_upd_voucher')->default(0);
            $table->smallInteger('c_procedencia_ext_anio')->nullable();
            $table->string('c_canales', 10)->nullable();
            $table->string('c_seguimiento', 10)->nullable();
            $table->decimal('n_nota', 4, 2)->nullable();
            $table->string('c_fijo', 30)->nullable();
            $table->string('c_datacadiat', 10)->nullable();
            $table->string('c_tiptrabiat', 10)->nullable();
            $table->string('c_entilabact', 100)->nullable();
            $table->string('c_tipprogiat', 10)->nullable();
            $table->string('c_ietnica', 10)->nullable();
            $table->string('c_lengua_nat', 10)->nullable();
            $table->string('c_idioma_ext', 10)->nullable();
            $table->string('c_cond_discap', 10)->nullable();
            $table->string('c_codigo_orcid', 20)->nullable();
            $table->string('d_archivo', 100)->nullable();
            $table->string('d_extension', 10)->nullable();
            $table->string('d_mimetype', 100)->nullable();
            $table->bigInteger('d_size')->default(0);
            $table->string('c_escala_pension', 5)->default('FA');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sga_tb_adm_cliente');
    }
};
